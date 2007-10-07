<?php 
/**
 * Transaction support for models in 1.2
 *
 * @version 0.2
 * @author Christian 'Jippi' Winther
 */
class TransactionBehavior extends ModelBehavior {
    /**
     * Settings: (false will disable them)
     *
     * - autocommit_on_start [ false | 0 | 1 ]
     *      Disable auto-commit on start?
     *
     * - autocommit_after_commit [ false | 0 | 1 ]
     *      Set auto-commit after successfull commit
     *
     * - autocommit_after_rollback [ false | 0 | 1 ]
     *      Set auto-commit after successfull rollback
     *
     * - throw_error [ false | true ]
     *      Should we call user_error if something is wrong?
     *
     * - error_level [ E_USER_* constants ]
     *      What level should the user_error use?
     *
     * - configure_key [ string ]
     *       What key should the transaction state be stored as
     *
     * @version 0.1
     * @since   0.1
     * @access  private
     * @var     array
     */
    var $settings = array(
        'autocommit_on_start'       => false,
        'autocommit_after_commit'   => 1,
        'autocommit_after_rollback' => 1,
        'throw_error'               => false,
        'error_level'               => E_USER_NOTICE,
        'configure_key'             => 'inTransaction'
    );

    /**
     * List of legal 'locks'
     *
     * @version 0.1
     * @since   0.1
     * @access  private
     * @var     array
     */
    var $validLocks = array('read','write');

    /**
     * Startup hook from the model
     *
     * @version 0.1
     * @since   0.1
     * @access  public
     * @param   AppModel $model
     * @param   array $config
     */
    function setup(&$model, $config = array()) {
        /**
         * Check if there has been set a transaction state in another model
         * Configure::read returns null if no value is found, so its safe to
         * set the default value for our transaction state ( false )
         */
        if( is_null( $this->_getTransactionState() ) ) {
            $this->_setTransactionState( false );
        }

        /**
         * If there was given any config settings to this behavior, merge them
         * with our default settings array
         * If the input arrays have the same string keys, then the later value for that key will overwrite the previous one
         */
        if( !is_null( $config ) && is_array( $config ) ) {
            $this->settings = array_merge( $this->settings, $config );
        }

        /**
         * If we wish to start an transaction at load time do so
         */
        if( $this->settings['autocommit_on_start'] !== false ) {
            $this->begin( $model );
        }
     }

    /**
     * Begin a database transaction
     *
     * @version 0.1
     * @since   0.1
     * @access  public
     * @param   AppModel $model
     * @param   int $autocmmit
     * @return  boolean
     */
    function begin( &$model, $args = array()) {
        if( $this->_getTransactionState() === false ) {
            $this->_setTransactionState( true );
            $model->query('SET autocommit=0');
            $model->query('begin');
            return true;
        }
        $this->_error('Transaction has already started');
        return false;
    }

    /**
     * Commits a database transaction
     *
     * @version 0.1
     * @since   0.1
     * @access  public
     * @param   AppModel $model
     * @param   integer $autocommit
     * @return  boolean
     */
    function commit( &$model, $args = array() ) {
        if( $this->_getTransactionState() === true ) {
            $this->_setTransactionState( false );

            $autoCommit = empty($args[0]) ? $this->settings['autocommit_after_commit'] : $args[0];
            $model->query('commit');
            if( $autoCommit !== false ) {
                $model->query('SET autocommit='. $autoCommit);
            }
            return true;
        }
        $this->_error('No transaction active');
        return false;
    }

    /**
     * Rollback a transaction
     *
     * @version 0.1
     * @since   0.1
     * @access  public
     * @param   AppModel $model
     * @param   integer $autocommit
     */
    function rollback( &$model, $args=array() ) {
        if( $this->_getTransactionState() === true ) {
            $this->_setTransactionState( false );
            $model->query('rollback');
            $autoCommit = empty($args[0]) ? $this->settings['autocommit_after_rollback'] : $args[0];
            if( $autoCommit !== false ) {
                $model->query('SET autocommit='. $autoCommit);
            }
            return true;
        }
        $this->_error('No transaction active');
        return false;
    }

    /**
     * Locks the model table for either READ or WRITE
     *
     * - Arg[0] is either 'READ' or 'WRITE'
     * - Arg[1]:
     *     If null     : Its going to lock the model table
     *     If string   : Locking the given table
     *     If array    : Going to lock all tables specified
     *                   NOTE: You have to specify model table aswell!
     *
     * @version 0.2
     * @since   0.1
     * @access  public
     * @param   AppModel $model
     * @param   array $args
     */
    function lockTable( &$model, $args = array( ) ) {
        $type  = strtolower( empty( $args[0] ) ? null  : $args[0] );
        $table = strtolower( empty( $args[1] ) ? $model->table : $args[1] );
        if( is_null( $type ) ) {
            $this->_error('Missing parameter for lockTable(), either READ or WRITE');
            return false;
        }
        if( array_search( $type, $this->validLocks ) !== false ) {
            if(is_array($table)) {
                $res = array();
                foreach ( $table AS $tableName ) {
                    $res[ $tableName ] = $model->query('LOCK TABLE '.$table.' '. strtoupper($type));
                }
                return $res;
            } else {
                $model->query('LOCK TABLE '.$table.' '. strtoupper($type));
                return true;
            }
        }
        return false;
    }

    /**
     * Remove all locks made on tables
     *
     * @version 0.1
     * @since   0.1
     * @access  public
     * @param   AppModel $model
     * @param   array $args
     */
    function unlockTable( &$model, $args = array() ) {
        $model->query('UNLOCK TABLES');
    }


    /**
     * Show an error to screen (When debug > 0 )
     *
     * @version 0.1
     * @since 0.1
     * @access private
     * @param string $string
     */
    function _error( $string ) {
        if( $this->settings['throw_error'] ) {
            trigger_error($string, $this->settings['error_level'] );
        }
    }

    /**
     * Get the current transaction state
     *
     * @version 0.1
     * @since 0.1
     * @access private
     * @return boolean
     */
    function _getTransactionState() {
        return Configure::read( $this->settings['configure_key'] );
    }

    /**
     * Write a new transaction state
     *
     * @version 0.1
     * @since 0.1
     * @access private
     * @param boolean $value
     */
    function _setTransactionState( $value ) {
        if( is_bool( $value ) ) {
            Configure::write( $this->settings['configure_key'], $value );
        }
        $this->_error('Not valid transaction state');
    }
}
?> 
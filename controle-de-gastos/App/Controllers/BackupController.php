<?php
    namespace App\Controllers;
    use CG\Controller\Action;

    class BackupController extends Action {

        public function backup(){
            shell_exec('cd .. && cd mysql && cd bin && mysqldump -u root db_cg tb_despesa tb_receita> D:\backup.sql');
            header('Location: /?backupResult=success');
        }

    }

?>
<?php

use Phinx\Migration\AbstractMigration;

class CreateUserTable extends AbstractMigration
{
    public function up()
    {
        $sql = '            CREATE TABLE `user` (
              `id` int(11) NOT NULL,
              `login` varchar(255) NOT NULL,
              `email` varchar(255) NOT NULL,
              `password` varchar(255) NOT NULL
            );
';


        $this->execute($sql);
    }

    public function down()
    {
        $sql = '            drop TABLE `user`
';


        $this->execute($sql);
    }
}

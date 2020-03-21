<?php

use Phinx\Migration\AbstractMigration;

class AddDumpData extends AbstractMigration
{
    public function up()
    {
        //test user: test // test
        $sql = "
            INSERT INTO users ( `name`, `email`, `password` ) VALUES ('test', 'test@mail.ru', '098f6bcd4621d373cade4e832627b4f6');
            INSERT INTO loyalty_source ( `name` ) VALUES ('raffle'), ('convertMoney');
            INSERT INTO things ( `name`, `size`, `weight` ) 
                VALUES 
                  ('War and Peace book', 100, 2), 
                  ('tv', 500, 15),
                  ('printer', 300, 5),
                  ('sportwear', 200, 3),
                  ('phone', 50, 1);
        ";

        $this->execute($sql);
    }

    public function down()
    {
        $sql = '
            TRUNCATE TABLE things;
            TRUNCATE TABLE loyalty_source;
            TRUNCATE TABLE users;
        ';

        $this->execute($sql);
    }
}

<?php

namespace Console\Commands;

use App;

class CreateTables
{
    public function exec()
    {
        $sql   = "CREATE TABLE `articles` (
                    id INT( 11 ) AUTO_INCREMENT PRIMARY KEY,
                    title VARCHAR( 255 ) default null, 
                    image_uri VARCHAR( 255 ) default null,
                    text TEXT default null, 
                    status VARCHAR( 12 ) default null,
                    created_at timestamp default null,
                    updated_at timestamp default null );";
        App::$db->pdo->query($sql);
        print("Created tables.\n");
    }
}
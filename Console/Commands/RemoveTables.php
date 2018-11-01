<?php

namespace Console\Commands;

use App;

class RemoveTables
{
    public function exec()
    {
        $table = 'articles';
        $sql   = "DROP TABLE IF EXISTS $table ;";
        App::$db->execute($sql, [':table' => $table,]);
        print("Remove $table Table.\n");
    }
}
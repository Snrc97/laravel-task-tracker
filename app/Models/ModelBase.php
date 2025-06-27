<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
class ModelBase extends Model
{



    public function hasField($fieldName): bool
    {
        $dbName = $this->getConnection()->getDatabaseName();
        $table = $this->getTable();
        $combine = "$dbName.$table";
        $fields = Schema::getColumnListing($combine);
        return in_array($fieldName, $fields);
    }

    public function getColumns(): array
    {
        $table = $this->getTable();
        return Schema::getColumnListing($table);
    }

    public static function getFieldColumnEnumValues(string $fieldName, bool $translated = true, string $lang_prefix = "all"): array
    {
        $ns = (new static());
        $table = $ns->getTable();
        $raw_query_string = "SHOW COLUMNS FROM `$table` LIKE '$fieldName'";

        $enumValues = DB::connection($ns->getConnectionName())->select($raw_query_string)[0]->Type;
        $enumValues = preg_replace("/(enum|set)\('(.+)'\)/", "\\2", $enumValues);

        $enumValues = explode("','", $enumValues);

        foreach ($enumValues as $key => $value) {
            $enumValues[$value] = $value;
            if ($translated) {
                $enumValues[$value] = __($lang_prefix . '.' . $value);
            }
            unset($enumValues[$key]);
        }
        return $enumValues;
    }

    public static function getFieldColumnValuesDistinct(string $fieldName, string $lang_prefix = null): array
    {
        $ns = (new static());
        $table = $ns->getTable();
        $raw_query_string = "SELECT DISTINCT `$fieldName` FROM `$table`";

        $values = DB::connection($ns->getConnectionName())->select($raw_query_string);
        $values = array_column($values, $fieldName);
        $values = array_filter($values);
        foreach($values as $key => $value) {
            $values[$value] = $value;
            if ($lang_prefix) {
                $values[$value] = $lang_prefix ? __($lang_prefix . '.' . $value) : $value;
            }
            unset($values[$key]);
        }



        return $values;
    }


}

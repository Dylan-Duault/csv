<?php

namespace Wilgucki\Csv\Traits;

trait CsvImportable
{
    public static function fromCsv($file)
    {
        $reader = \CsvReader::open($file);
        $reader->getHeader();
        while (($row = $reader->readLine()) !== false) {
            $model = self::findOrNew($row['id']);
            foreach ($row as $column => $value) {
                if ($column == 'id') {
                    continue;
                }
                $model->{$column} = $value;
            }
            $model->save();
        }
    }
}
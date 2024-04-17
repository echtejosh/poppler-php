<?php

class pdf_to_html_text_block
{
    static private $arrayBlocks = [];
    static private $maxTextYSeparator = 5; //top position

    //#####################################################################
    static private function returnArrayTextPropertyWithLinkedMultipleIndexes($pageObj, $prop)
    {
        $propValues = [];

        foreach ($pageObj as $index => $item) {
            if ($item['tag'] === "image") {
                continue;
            }
            $value = (string)$item[$prop];
            if (!isset($propValues[$value])) {
                $propValues[$value] = [];
            }
            $propValues[$value][] = $index;
        }

        foreach ($propValues as $prop => $arr) {

            if (sizeof($arr) <= 1) {
                unset($propValues[$prop]);
            } else {
                sort($propValues[$prop], SORT_NUMERIC);
            }

        }

        ksort($propValues);
        return $propValues;  //
    }

    //#####################################################################
    static public function process($page)
    {

        $obj = digi_pdf_to_html::$arrayPages[$page]['content'];
        $len = sizeof($obj);
        $arr = self::returnArrayTextPropertyWithLinkedMultipleIndexes($obj, "left");

        print_r($obj);
        exit;
        print_r($arr);
        exit;

        $leftValues = [];
        foreach ($obj as $index => $item) {
            if ($item['tag'] === "image") {
                continue;
            }
            $left = $item['left'];
            if (!isset($leftValues[$left])) {
                $leftValues[$left] = [];
            }
            $leftValues[$left][] = $index;
        }

        print_r($leftValues);
    }
    //#####################################################################

}

?>
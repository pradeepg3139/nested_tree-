<?php
	$json_input =file_get_contents("json-input.txt");
	$input_array = json_decode($json_input,true);
	foreach ($input_array as $key => $value) {
		foreach ($value as $sub_key => $sub_value) {
			$simplified_arr[]= $sub_value;
		}
	}

function buildTree(array $elements, $parentId = null) {
    $branch = array();

    foreach ($elements as $element) {
    	//var_dump($element);
        if ($element['parent_id'] == $parentId) {
            $children = buildTree($elements, $element['id']);
            if ($children) {
                $element['children'] = $children;
            }
            $branch[] = $element;
        }
    }

    return $branch;
}

$tree = buildTree($simplified_arr);
print json_encode($tree);
?>
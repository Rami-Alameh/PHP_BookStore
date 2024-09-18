<?php
function get_all_categories($conn) {
    $categorysql = "SELECT * FROM categories";
    $result = $conn->query($categorysql);

    $categories = array();

    if ($result->num_rows > 0) {
        while ($category = $result->fetch_assoc()) {
            $categories[$category['id']] = $category; // Use the category ID as a key to get the name from the category
        }
    }

    return $categories;
}
function get_category_by_id($conn, $id){
    $categorysql = "SELECT * FROM categories WHERE id = $id";
    $result = $conn->query($categorysql);

    // query success and results ==1 no duplicate ids 
    if ($result && $result->num_rows == 1) {
        // Fetch the category
        $category = $result->fetch_assoc();
        
        return $category;
    } else {
        // Return null if no category found
        return null;
    }
}

?>
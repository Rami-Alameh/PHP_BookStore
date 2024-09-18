<?php 
// function get_author_by_id($id, $conn) {
//     $authorsql = "SELECT * FROM authors WHERE id=?";
//     $stmt = $conn->prepare($authorsql);
//     $stmt->bind_param("i", $id);
//     $stmt->execute();
//     $result = $stmt->get_result();

//     if ($result->num_rows == 1) {
//         $author = $result->fetch_assoc();
//     } else {
//         $author = 0;
//     }

//     $stmt->close();
//     return $author;
// }
function get_all_authors($conn) {
    $authorsql = "SELECT * FROM authors ORDER BY name asc";
    $result = $conn->query($authorsql);

    $authors = array();

    if ($result->num_rows > 0) {
        while ($author = $result->fetch_assoc()) {
            $authors[$author['id']] = $author; // Use the author ID as the array key
        }
    }

    return $authors;
}
function get_author_by_id($conn, $id){
    $authorsql = "SELECT * FROM authors WHERE id = $id";
    $result = $conn->query($authorsql);

    // query success and results ==1 no duplicate ids 
    if ($result && $result->num_rows == 1) {
        // Fetch the author
        $author = $result->fetch_assoc();
        
        return $author;
    } else {
        // Return null if no author found
        return null;
    }
}
?>
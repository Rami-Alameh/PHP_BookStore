<?php function get_book_by_id($conn, $id) {
    $booksql = "SELECT * FROM books WHERE id = $id";
    $result = $conn->query($booksql);

    if ($result && $result->num_rows == 1) {
        // Fetch the category
        $book = $result->fetch_assoc();
        
        return $book;
    } else {
        // Return null if no category found
        return null;
    }
}
?>

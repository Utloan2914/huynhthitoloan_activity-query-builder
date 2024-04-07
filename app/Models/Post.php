<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    public function getAllPosts()
    {
        $posts = DB::table('posts')->get();
        return $posts;
    }

    public function getOnePost($id)
    {
        $post = DB::table('posts')->where('id', $id)->first();
        return $post;
    }

    public function mySQLCRUD()
    {
        $server = "localhost";
        $username = "activity_query_builder";
        $password = "";
        $database = "query";

        $mysqli = new \mysqli($server, $username, $password, $database);

        if ($mysqli->connect_errno) {
            echo "Kết nối MySQLi failed: " . $mysqli->connect_error;
            return;
        }


        $title = "post mới tạo";
        $description = "nội dung";
        $sqlCreate = "INSERT INTO posts (title, description) VALUES (?, ?)";
        $stmtCreate = $mysqli->prepare($sqlCreate);
        $stmtCreate->bind_param("ss", $title, $description);
        $stmtCreate->execute();


        $postId = 51;
        $sqlRead = "SELECT * FROM posts WHERE id = ?";
        $stmtRead = $mysqli->prepare($sqlRead);
        $stmtRead->bind_param("i", $postId);
        $stmtRead->execute();
        $result = $stmtRead->get_result();
        $post = $result->fetch_assoc();


        $newTitle = "Updated Title";
        $newDescription = "Updated content of the post";
        $sqlUpdate = "UPDATE posts SET title = ?, description = ? WHERE id = ?";
        $stmtUpdate = $mysqli->prepare($sqlUpdate);
        $stmtUpdate->bind_param("ssi", $newTitle, $newDescription, $postId);
        $stmtUpdate->execute();


        $sqlDelete = "DELETE FROM posts WHERE id = ?";
        $stmtDelete = $mysqli->prepare($sqlDelete);
        $stmtDelete->bind_param("i", $postId);
        $stmtDelete->execute();


        $stmtCreate->close();
        $stmtRead->close();
        $stmtUpdate->close();
        $stmtDelete->close();
        $mysqli->close();
    }

    public function PDO()
    {
        $postId = 51;
        $title = "New Post";
        $content = "Content of the new post";

        DB::table('posts')->insert(['title' => $title, 'description' => $content]);

        $post = DB::table('posts')->where('id', $postId)->first();

        $newTitle = "Updated Title";
        $newContent = "Updated content of the post";
        DB::table('posts')->where('id', $postId)->update(['title' => $newTitle, 'description' => $newContent]);

        DB::table('posts')->where('id', $postId)->delete();
    }
}

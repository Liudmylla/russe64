<?php

namespace App\Table;

use App\PaginatedQuery;
use App\Model\Post;
use App\Connection;


final class PostTable extends Table
{
    protected $table = "post";
    protected $class = Post::class;

    public function updatePost(Post $post): void
    {
       
        $this->update([
            'name' => $post->getName(),
            'slug' => $post->getSlug(),
            'validated'=> null,
            'content' => $post->getContent(),
            'created_at' => $post->getCreatedAt()->format('Y-m-d H:i:s'),
            'image' => $post->getImage()
        ], $post->getID());
       
    }
    public function updatePostAdmin(Post $post): void
    {

        $this->update([
            'name' => $post->getName(),
            'slug' => $post->getSlug(),
            'validated' => $post->getValidated(),
            'content' => $post->getContent(),
            'created_at' => $post->getCreatedAt()->format('Y-m-d H:i:s'),
            'image' => $post->getImage()
        ], $post->getID());
    }
    public function createPost(Post $post): void
    {
     
        $id = $this->create([
            'id' => $post->getID(),
            'id_user'=>$post->getUserId(),
            'name' => $post->getName(),
            'slug' => $post->getSlug(),
            'content' => $post->getContent(),
            'created_at' => $post->getCreatedAt()->format('Y-m-d H:i:s'),
            'image'=>$post->getImage()
        ]);
        $post->setID($id);

        
      
    }

    public function attachCategories($id, array $categories): void 
    {
        $this->pdo->exec('DELETE FROM post_category WHERE post_id= ' . $id);
        $query =  $this->pdo->prepare('INSERT INTO post_category SET post_id = ?, category_id = ?');
        foreach ($categories as $category) {
            $query->execute([$id, $category]);
        }
       
    }



    public function findPaginated()
    {
        $paginatedQuery = new PaginatedQuery(
            "SELECT * FROM {$this->table} ORDER BY created_at DESC",
            "SELECT COUNT(id) FROM {$this->table}",
            $this->pdo
        );
        $posts = $paginatedQuery->getItems(Post::class);
        (new CategoryTable($this->pdo))->hydratePosts($posts);
        return [$posts, $paginatedQuery];
    }

    public function findPaginatedForCategory(int $categoryID)
    {
        $paginatedQuery = new PaginatedQuery(
            "SELECT p.* 
                FROM {$this->table} p
                JOIN post_category pc ON pc.post_id = p.id
                WHERE pc.category_id = {$categoryID}
                ORDER BY created_at DESC ",
            "SELECT COUNT(category_id) FROM post_category WHERE category_id= {$categoryID}",
        );
        $posts = $paginatedQuery->getItems(Post::class);
        (new CategoryTable($this->pdo))->hydratePosts($posts);
        return [$posts, $paginatedQuery];
    }
     public function allUserPosts($id_user): array
    {
        $sql = "SELECT * FROM {$this->table} WHERE id_user={$id_user}";
        return  $this->pdo->query($sql, \PDO::FETCH_CLASS, $this->class)->fetchAll();
    }
    public function  str_random($length)
    {
        $alphabet = "0123456789AZERTYUIOPQSDFGHJKLMWXCVBNazertyuiopqsdfghjklmwxcvbn";
        return substr(str_shuffle(str_repeat($alphabet, $length)), 0, $length);
    }
    
}

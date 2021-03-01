<?php

namespace App\Model;

use App\Helpers\Text;
use \DateTime;
use App\Connection;


class Post
{
    private $id;
    private $id_user;
    private $image;
    private $slug;
    private $name;
    private $content;
    private $created_at;
    private $categories = [];
    private $oldImage;
    private $pendingUpload = false;
    private $validated = false;

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }
    public function getContent(): ?string
    {
        return $this->content;
    }
    public function setContent(string $content): self
    {
        $this->content = $content;
        return $this;
    }
    public function getFormattedContent(): ?string
    {
        return nl2br(e($this->content));
    }

    public function getExcerpt(): ?string
    {
        if ($this->content === null) {
            return null;
        }
        return nl2br(htmlentities(Text::excerpt($this->content, 60)));
    }

    public function getCreatedAt(): DateTime
    {
        return new DateTime($this->created_at);
    }

    public function setUserName(string $username): self
    {
        $this->username = $username;
        return $this;
    }

    public function setCreatedAt(string $date): self
    {
        $this->created_at = $date;
        return $this;
    }
    public function getSlug(): ?string
    {
        return $this->slug;
    }
    public function setSlug(string $slug): self
    {
        $this->slug = $slug;
        return $this;
    }
    public function getID(): ?int
    {
        return $this->id;
    }
    public function setID(int $id): self
    {
        $this->id = $id;
        return $this;
    }
    /**
     * @return Category[]
     */
    public function getCategories(): array
    {
        return $this->categories;
    }

    public function getCategoriesIds(): array
    {
        $ids = [];
        foreach ($this->categories as $category) {
            $ids[] = $category->getID();
        }
        return $ids;
    }
    public function setCategories(array $categories): self
    {
        $this->categories = $categories;
        return $this;
    }

    public function addCategory(Category $category): void
    {
        $this->categories[] = $category;
        $category->setPost($this);
    }
    public function setUserId(int $id_user): self
    {
        $this->id_user = $id_user;
        return $this;
    }
    public function getUserId(): ?int
    {
        return $this->id_user;
    }
   
    function getUName(int $id_user): ?string
    {

        $pdo = Connection::getPDO();
        $data = ['id_user' => $id_user];
        $sql = 'SELECT username FROM user WHERE id_user= :id_user';
        $request = $pdo->prepare($sql);
        $request->execute($data);
        $result = $request->fetch();

        if (empty($result['username'])) :
            $result['username'] = 'Anonymus';
        endif;
        return $result['username'];
    }


    /**
     * Get the value of image
     */
    public function getImage(): ?string
    {
        return $this->image;
    }

    public function getImageURL(string $format): ?string
    {
        if (empty($this->image)) {
            return null;
        }
        return '/uploads/posts/' . $this->image . '_' . $format . '.jpg';
    }

    /**
     * Set the value of image
     *
     * @return  self
     */
    public function setImage($image): self
    {
        if (is_array($image) && !empty($image['tmp_name'])) {
            if (!empty($this->image)) {
                $this->oldImage = $this->image;
            }
            $this->pendingUpload = true;
            $this->image = $image['tmp_name'];
        }
        if (is_string($image) && !empty($image)) {
            $this->image = $image;
        }
        return $this;
    }


    /**
     * Get the value of oldImage
     */
    public function getOldImage(): ?string
    {
        return $this->oldImage;
    }
    public function shouldUpload(): bool
    {
        return $this->pendingUpload;
    }
    public function getValidated(): ?bool
    {
        return $this->validated;
    }
    public function setValidated(int $validated): self
    {
        $this->validated = $validated;
        return $this;
    }
}

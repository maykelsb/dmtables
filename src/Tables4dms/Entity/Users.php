<?php
/**
 * This file is part of Tables4DMs project.
 *
 * @license https://opensource.org/licenses/MIT The MIT License
 * @copyright 2017 Maykel S. Braz
 * @link http://github.com/maykelsb/tables4dms-api
 */

namespace Tables4dms\Entity;

use Doctrine\ORM\Mapping as ORM;
use Swagger\Annotations as SWG;

/**
 * User entity.
 *
 * @ORM\Entity(repositoryClass="Tables4dms\Repository\UsersRepository")
 * @ORM\Table(name="users")
 * @SWG\Definition(definition="User")
 */
class Users
{
    /**
     * User id.
     *
     * @var integer
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     * @SWG\Property()
     */
    private $id;

    /**
     * User name.
     *
     * @var string
     * @ORM\Column(type="string")
     * @SWG\Property()
     */
    private $user;

    /**
     * User password.
     *
     * @var string
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * User full name.
     *
     * @var string
     * @ORM\Column(type="string")
     * @SWG\Property()
     */
    private $fullname;

    /**
     * Date of user creation.
     *
     * @var \DateTime
     * @ORM\Column(type="datetime", name="created_at")
     * @SWG\Property()
     */
     private $createdAt;

    /**
     * Date of last update on user.
     *
     * @var \DateTime
     * @ORM\Column(type="datetime", name="updated_at")
     * @SWG\Property()
     */
    private $updatedAt;

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set user.
     *
     * @param string $user
     *
     * @return Users
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user.
     *
     * @return string
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set password.
     *
     * @param string $password
     *
     * @return Users
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password.
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set fullname.
     *
     * @param string $fullname
     *
     * @return Users
     */
    public function setFullname($fullname)
    {
        $this->fullname = $fullname;

        return $this;
    }

    /**
     * Get fullname.
     *
     * @return string
     */
    public function getFullname()
    {
        return $this->fullname;
    }

    /**
     * Set createdAt.
     *
     * @param \DateTime $createdAt
     *
     * @return Users
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt.
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt.
     *
     * @param \DateTime $updatedAt
     *
     * @return Users
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt.
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    public function __toString()
    {
        return $this->getFullname();
    }
    
}

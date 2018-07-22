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
use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Sheet entity.
 *
 * @author Maykel S. Braz <maykelsb@yahoo.com.br>
 * @ORM\Entity(repositoryClass="Tables4dms\Repository\SheetRepository")
 * @ORM\Table(name="sheet")
 * @SWG\Definition(definition="Sheet")
 */
class Sheet extends AbstractEntity
{
    const SHEET_ACTIVE = 'A';
    const SHEET_DELETED = 'D';
    const SHEET_SUSPENDED = 'S';

    /**
     * Sheet id.
     *
     * @var integer
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     * @SWG\Property()
     */
    private $id;

    /**
     * Sheet name.
     *
     * @var string
     * @ORM\Column(type="string", length=50)
     * @SWG\Property()
     */
    private $name;

    /**
     * Sheet description.
     *
     * @var string
     * @ORM\Column(type="string")
     * @SWG\Property()
     */
    private $description;

    /**
     * Source url.
     *
     * @var string
     * @ORM\Column(type="string")
     * @SWG\Property()
     */
    private $url;

    /**
     * Sheet creator.
     * @var string
     * @ORM\Column(type="string")
     * @SWG\Property()
     */
    private $author;

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
     * Many sheets have one creator.
     *
     * @ORM\ManyToOne(targetEntity="User", inversedBy="sheets")
     * @ORM\JoinColumn(name="userid", referencedColumnName="id")
     */
    private $user;

    /**
     * Sheet situation.
     *
     * @var string
     * @ORM\Column(type="string")
     * @SWG\Property()
     */
    private $situation;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
    }

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
     * Set name.
     *
     * @param string $name
     *
     * @return Sheet
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description.
     *
     * @param string $description
     *
     * @return Sheet
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description.
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set url.
     *
     * @param string $url
     *
     * @return Sheet
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url.
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set author.
     *
     * @param string $author
     *
     * @return Sheet
     */
    public function setAuthor($author)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author.
     *
     * @return string
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set createdAt.
     *
     * @param \DateTime $createdAt
     *
     * @return Sheet
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
     * @return Sheet
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

    /**
     * Set user.
     *
     * @param \Tables4dms\Entity\User|null $user
     *
     * @return Sheet
     */
    public function setUser(\Tables4dms\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user.
     *
     * @return \Tables4dms\Entity\User|null
     */
    public function getUser()
    {
        return $this->user;
    }

    static public function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('name', new Assert\NotBlank())
            ->addPropertyConstraint('name', new Assert\Length(['max' => 50]));
        $metadata->addPropertyConstraint('user', new Assert\NotBlank());
        $metadata->addPropertyConstraint('url', new Assert\Length(['max' => 255]))
            ->addPropertyConstraint('url', new Assert\Url());
        $metadata->addPropertyConstraint('author', new Assert\Length(['max' => 255]));
    }

    /**
     * Set situation.
     *
     * @param string $situation
     * @return \Tables4dms\Entity\Sheet
     */
    public function setSituation($situation)
    {
        $this->situation = $situation;
        return $this;
    }

    /**
     * Get situation.
     *
     * @return string
     */
    public function getSituation()
    {
        return $this->situation;
    }
}

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
class Sheet
{
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
    }
}


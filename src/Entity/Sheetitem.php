<?php
/**
 * This file is part of Tables4DMs project.
 *
 * @license https://opensource.org/licenses/MIT The MIT License
 * @copyright 2017 Maykel S. Braz
 * @link http://github.com/maykelsb/tables4dms-api
 */

namespace Tables4DMs\Entity;

use Doctrine\ORM\Mapping as ORM;

use Swagger\Annotations as SWG;

use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Sheetitem
 *
 * @author Maykel S. Braz <maykelsb@yahoo.com.br>
 * @ORM\Table(
 *  name="sheetitem",
 *  indexes={
 *      @ORM\Index(name="IDX_9F9311165479D2D0", columns={"sheetid"}),
 *      @ORM\Index(name="IDX_9F9311161F1B7A1F", columns={"subsheetid"})
 *  }
 * )
 * @ORM\Entity(repositoryClass="Tables4DMs\Repository\SheetitemRepository")
 * @SWG\Definition(definition="Sheet")
 */
class Sheetitem
{
    /**
     * Sheetitem id.
     *
     * @var int
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @SWG\Property()
     */
    private $id;

    /**
     * Represents a number which identifies that sheet item in a dice row.
     *
     * @var int
     * @ORM\Column(
     *  name="dicenumber",
     *  type="integer",
     *  nullable=false,
     *  options={
     *      "comment"="Represents a number which identifies that sheet item in a dice row"
     *  }
     * )
     * @SWG\Property()
     * @Assert\NotBlank
     */
    private $dicenumber;

    /**
     * Sheet item description.
     *
     * @var string
     * @ORM\Column(
     *  name="description",
     *  type="string",
     *  length=255,
     *  nullable=false,
     *  options={"comment"="Sheet item description"}
     * )
     * @SWG\Property()
     * @Assert\NotBlank
     * @Assert\Length(max=255)
     */
    private $description;

    /**
     * Date of sheet item creation.
     *
     * @var \DateTime
     * @ORM\Column(
     *  name="created_at",
     *  type="datetime",
     *  nullable=false,
     *  options={"default"="CURRENT_TIMESTAMP"}
     * )
     * @SWG\Property()
     */
    private $createdAt;

    /**
     * Date of last update on item.
     *
     * @var \DateTime
     * @ORM\Column(
     *  name="updated_at",
     *  type="datetime",
     *  nullable=false,
     *  options={"default"="CURRENT_TIMESTAMP"}
     * )
     * @SWG\Property()
     */
    private $updatedAt;

    /**
     * Sheet to which the item belongs to.
     *
     * @var \Tables4dms\Entity\Sheet
     * @ORM\ManyToOne(targetEntity="Tables4DMs\Entity\Sheet")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="sheetid", referencedColumnName="id")
     * })
     * @SWG\Property()
     * @Assert\NotBlank
     */
    private $sheet;

    /**
     * Subsheet id. Used when a item is another.
     *
     * @var \Tables4dms\Entity\Sheet
     * @ORM\ManyToOne(targetEntity="Tables4DMs\Entity\Sheet")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="subsheetid", referencedColumnName="id")
     * })
     * @SWG\Property()
     */
    private $subsheet;

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
     * Set dicenumber.
     *
     * @param int $dicenumber
     *
     * @return Sheetitem
     */
    public function setDicenumber($dicenumber)
    {
        $this->dicenumber = $dicenumber;

        return $this;
    }

    /**
     * Get dicenumber.
     *
     * @return int
     */
    public function getDicenumber()
    {
        return $this->dicenumber;
    }

    /**
     * Set description.
     *
     * @param string $description
     *
     * @return Sheetitem
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
     * @return Sheetitem
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
     * @return Sheetitem
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
     * Set sheet.
     *
     * @param \Tables4DMs\Entity\Sheet|null $sheet
     *
     * @return Sheetitem
     */
    public function setSheet(\Tables4DMs\Entity\Sheet $sheet = null)
    {
        $this->sheet = $sheet;

        return $this;
    }

    /**
     * Get sheet.
     *
     * @return \Tables4DMs\Entity\Sheet|null
     */
    public function getSheet()
    {
        return $this->sheet;
    }

    /**
     * Set subsheet.
     *
     * @param \Tables4DMs\Entity\Sheet|null $subsheet
     *
     * @return Sheetitem
     */
    public function setSubsheetid(\Tables4DMs\Entity\Sheet $subsheet = null)
    {
        $this->subsheet = $subsheet;

        return $this;
    }

    /**
     * Get subsheet.
     *
     * @return \Tables4DMs\Entity\Sheet|null
     */
    public function getSubsheet()
    {
        return $this->subsheet;
    }
}

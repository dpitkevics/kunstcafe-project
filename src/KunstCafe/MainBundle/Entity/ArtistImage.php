<?php

namespace KunstCafe\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * ArtistImage
 *
 * @ORM\Table(name="artist_images")
 * @ORM\Entity
 */
class ArtistImage
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="artist", type="integer")
     */
    /**
     * @var \KunstCafe\MainBundle\Entity\Artist
     *
     * @ORM\ManyToOne(targetEntity="\KunstCafe\MainBundle\Entity\Artist", inversedBy="artistImages")
     * @ORM\JoinColumn(name="artist_id", referencedColumnName="id")
     */
    private $artist;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=255)
     */
    private $image;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set artist
     *
     * @param \KunstCafe\MainBundle\Entity\Artist $artist
     * @return ArtistImage
     */
    public function setArtist(\KunstCafe\MainBundle\Entity\Artist $artist)
    {
        $this->artist = $artist;

        return $this;
    }

    /**
     * Get artist
     *
     * @return \KunstCafe\MainBundle\Entity\Artist
     */
    public function getArtist()
    {
        return $this->artist;
    }

    /**
     * Set image
     *
     * @param UploadedFile $image
     * @return $this
     */
    public function setImage($image = null)
    {
        if ($image !== null) {
            $this->image = $image;
        }

        return $this;
    }

    /**
     * Get image
     *
     * @return UploadedFile
     */
    public function getImage()
    {
        return $this->image;
    }

    public function getAbsolutePath()
    {
        return null === $this->path
            ? null
            : $this->getUploadRootDir().'/'.$this->path;
    }

    public function getWebPath()
    {
        return null === $this->path
            ? null
            : $this->getUploadDir().'/'.$this->path;
    }

    protected function getUploadRootDir()
    {
        // the absolute directory path where uploaded
        // documents should be saved
        return __DIR__ . '/../../../../web/' . $this->getUploadDir();
    }

    protected function getUploadDir()
    {
        // get rid of the __DIR__ so it doesn't screw up
        // when displaying uploaded doc/image in the view.
        return 'uploads/media';
    }

    public function upload()
    {
        // the file property can be empty if the field is not required
        if (null === $this->getImage()) {
            return;
        }

        $imageName = md5(uniqid(rand(), true)) . '.' . $this->getImage()->guessExtension();

        // use the original file name here but you should
        // sanitize it at least to avoid any security issues

        // move takes the target directory and then the
        // target filename to move to
        $this->getImage()->move(
            $this->getUploadRootDir(),
            $imageName
        );

        // set the path property to the filename where you've saved the file
        //$this->path = $this->getFile()->getClientOriginalName();

        // clean up the file property as you won't need it anymore

        $this->image = $imageName;
    }
}

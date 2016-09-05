<?php

namespace Common\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * @ORM\Entity(repositoryClass="Common\UserBundle\Repository\UserRepository")
 * @ORM\Table(name="users")
 * @ORM\HasLifecycleCallbacks
 */
class User implements AdvancedUserInterface, \Serializable {
    
    const DEFAULT_AVATAR = 'default-avatar.png';
    const UPLOAD_DIR = 'uploads/avatars/';
    
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @ORM\Column(type="string", length = 20, unique = true, nullable = true)
     */
    private $username = '';
    
    /**
     * @ORM\Column(type="string", length = 120, unique = true)
     */
    private $email;
    
    /**
     * @ORM\Column(type="string", length = 64)
     */
    private $password;
    
    private $plainPassword;
    
    /**
     * @ORM\Column(name="account_non_expired", type="boolean")
     */
    private $accountNonExpired = true;
    
    /**
     * @ORM\Column(name="account_non_locked", type="boolean")
     */
    private $accountNonLocked = true;
    
    /**
     * @ORM\Column(name="credentials_non_expired", type="boolean")
     */
    private $credentialsNonExpired = true;
    
    /**
     * @ORM\Column(type="boolean")
     */
    private $enabled = false;
    
    /**
     * @ORM\Column(type="array")
     */
    private $roles;
    
    /**
     * @ORM\Column(name="action_token", type="string", length = 20, nullable = true)
     */
    private $actionToken;
    
    /**
     * @ORM\Column(name="register_date", type="datetime")
     */
    private $registerDate;
    
    /**
     * @ORM\Column(type="string", length = 100, nullable = true)
     */
    private $avatar;
    
    /**
     * @ORM\Column(type="integer")
     */
    private $typ;
    
   /**
     * @ORM\OneToOne(targetEntity="Rexi\UserBundle\Entity\UserInfo", mappedBy="id_user")
     */
    protected $info;
    
    /**
     * @var UploadedFile
     */
    private $avatarFile;
    
    private $avatarTemp;
    
    /**
     * @ORM\Column(type="datetime", nullable = true)
     */
    private $updateDate;
    
    public function __construct() {
        $this->registerDate = new \DateTime();
    }
    
    public function getAvatarFile() {
        return $this->avatarFile;
    }

    public function setAvatarFile(UploadedFile $avatarFile) {
        $this->avatarFile = $avatarFile;
        $this->updateDate = new \DateTime();
        return $this;
    }
    
    public function eraseCredentials() {
        $this->plainPassword = null;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getRoles() {
        if(empty($this->roles)){
            return array('ROLE_USER');
        }
        
        return $this->roles;
    }

    public function getSalt() {
        return null;
    }

    public function getUsername() {
        if($this->username === null)
            $this->username = '';
            
        return $this->username;
    }

    public function isAccountNonExpired() {
        return $this->accountNonExpired;
    }

    public function isAccountNonLocked() {
        return $this->accountNonExpired;
    }

    public function isCredentialsNonExpired() {
        return $this->accountNonLocked;
    }

    public function isEnabled() {
        return $this->enabled;
    }

    public function serialize() {
        return serialize(array(
            $this->id,
            $this->username,
            $this->password
        ));
    }

    public function unserialize($serialized) {
        list(
            $this->id,
            $this->username,
            $this->password
        ) = unserialize($serialized);
    }


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
     * Set username
     *
     * @param string $username
     * @return User
     */
    public function setUsername($username)
    {        
        $this->username = $username;

        return $this;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Set accountNonExpired
     *
     * @param boolean $accountNonExpired
     * @return User
     */
    public function setAccountNonExpired($accountNonExpired)
    {
        $this->accountNonExpired = $accountNonExpired;

        return $this;
    }

    /**
     * Get accountNonExpired
     *
     * @return boolean 
     */
    public function getAccountNonExpired()
    {
        return $this->accountNonExpired;
    }

    /**
     * Set accountNonLocked
     *
     * @param boolean $accountNonLocked
     * @return User
     */
    public function setAccountNonLocked($accountNonLocked)
    {
        $this->accountNonLocked = $accountNonLocked;

        return $this;
    }

    /**
     * Get accountNonLocked
     *
     * @return boolean 
     */
    public function getAccountNonLocked()
    {
        return $this->accountNonLocked;
    }

    /**
     * Set credentialsNonExpired
     *
     * @param boolean $credentialsNonExpired
     * @return User
     */
    public function setCredentialsNonExpired($credentialsNonExpired)
    {
        $this->credentialsNonExpired = $credentialsNonExpired;

        return $this;
    }

    /**
     * Get credentialsNonExpired
     *
     * @return boolean 
     */
    public function getCredentialsNonExpired()
    {
        return $this->credentialsNonExpired;
    }

    /**
     * Set enabled
     *
     * @param boolean $enabled
     * @return User
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;

        return $this;
    }

    /**
     * Get enabled
     *
     * @return boolean 
     */
    public function getEnabled()
    {
        return $this->enabled;
    }

    /**
     * Set roles
     *
     * @param array $roles
     * @return User
     */
    public function setRoles($roles)
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * Set actionToken
     *
     * @param string $actionToken
     * @return User
     */
    public function setActionToken($actionToken)
    {
        $this->actionToken = $actionToken;

        return $this;
    }

    /**
     * Get actionToken
     *
     * @return string 
     */
    public function getActionToken()
    {
        return $this->actionToken;
    }

    /**
     * Set registerDate
     *
     * @param \DateTime $registerDate
     * @return User
     */
    public function setRegisterDate($registerDate)
    {
        $this->registerDate = $registerDate;

        return $this;
    }

    /**
     * Get registerDate
     *
     * @return \DateTime 
     */
    public function getRegisterDate()
    {
        return $this->registerDate;
    }

    /**
     * Set avatar
     *
     * @param string $avatar
     * @return User
     */
    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;

        return $this;
    }

    /**
     * Get avatar
     *
     * @return string 
     */
    public function getAvatar()
    {        
        if(null == $this->avatar){
            return User::UPLOAD_DIR.User::DEFAULT_AVATAR;
        }
        
        return User::UPLOAD_DIR.$this->avatar;
    }
    
    public function getPlainPassword() {
        return $this->plainPassword;
    }

    public function setPlainPassword($plainPassword) {
        $this->plainPassword = $plainPassword;
    }

    /**
     * Set typ
     *
     * @param integer $typ
     * @return User
     */
    public function setTyp($typ)
    {
        $this->typ = $typ;

        return $this;
    }

    /**
     * Get typ
     *
     * @return integer 
     */
    public function getTyp()
    {
        return $this->typ;
    }

    /**
     * Set info
     *
     * @param \Rexi\UserBundle\Entity\UserInfo $info
     * @return User
     */
    public function setInfo(\Rexi\UserBundle\Entity\UserInfo $info = null)
    {
        $this->info = $info;

        return $this;
    }

    /**
     * Get info
     *
     * @return \Rexi\UserBundle\Entity\UserInfo 
     */
    public function getInfo()
    {
        return $this->info;
    }
    
    /**
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function preSave() {
        if(null !== $this->getAvatarFile()){
            
            if(null !== $this->avatar){
                $this->avatarTemp = $this->avatar;
            }
            
            $avatarName = sha1(uniqid(null, true));
            $this->avatar = $avatarName.'.'.$this->getAvatarFile()->guessExtension();
        }
    }
    
    /**
     * @ORM\PostPersist
     * @ORM\PostUpdate
     */
    public function postSave(){
        if(null !== $this->getAvatarFile()){

            $this->getAvatarFile()->move($this->getUploadRootDir(), $this->avatar);
            unset($this->avatarFile);
            
            if(null !== $this->avatarTemp){
                unlink($this->getUploadRootDir().$this->avatarTemp);
                unset($this->avatarTemp);
            }
        }
    }
    
    protected function getUploadRootDir() {
        return __DIR__.'/../../../../web/'.User::UPLOAD_DIR;
    }
}

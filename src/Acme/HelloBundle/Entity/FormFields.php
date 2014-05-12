<?php
namespace Acme\HelloBundle\Entity;

class FormFields
{
    protected $formFields;

    protected $name;
    protected $email;
    protected $country;
    protected $gender;
    
    public function getFormFields()
    {
        return $this->task;
    }
    public function setFormFields($formFields)
    {
        $this->formFields = $formFields;
    }

    public function getEmail()
    {
        return $this->email;
    }
    public function setEmail($email)
    {
        $this->email = $email;
    }
    public function getName()
    {
        return $this->name;
    }
    public function setName($name)
    {
        $this->name = $name;
    }
    public function setCountry($country)
    {
		$this->country = $country;
	}
	public function getCountry()
	{
		return $this->country;
	}
	public function setGender($gender)
	{
		$this->gender = $gender;
	}
	public function getGender()
	{
		return $this->gender;
	}
}
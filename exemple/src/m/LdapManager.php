<?php
class LdapManager
{
	private $_ldapuri;
	private $_dn;
	private $_ldaphost;
	private $_ldapport;
	private $_ldapconn;
	private $_manager;
  
    public function __construct(array $donnees){
        $this->hydrate($donnees);
    }
    public function hydrate(array $donnees){
        foreach ($donnees as $key => $value){
            // On récupère le nom du setter correspondant à l'attribut.
            $method = 'set'.ucfirst($key);
            // Si le setter correspondant existe.
            if (method_exists($this, $method)){
              // On appelle le setter.
              $this->$method($value);
            }
        }
    }

    public function getLdapuri()
    {
        return $this->_ldapuri;
    }
    public function getDn()
    {
        return $this->_dn;
    }
    public function getLdaphost()
    {
        return $this->_ldaphost;
    }
    public function getLdapport()
    {
        return $this->_ldapport;
    }
    public function getManager()
    {
        return $this->_manager;
    }

    public function setLdapuri($ldapuri)
    {
        $this->_ldapuri = $ldapuri;
    }
    public function setDn($dn)
    {
        $this->_dn = $dn;
    }
    public function setLdaphost($ldaphost)
    {
        $this->_ldaphost = $ldaphost;
    }
    public function setLdapport($ldapport)
    {
        $this->_ldapport = $ldapport;
    }
    public function setManager(StudentManager $manager)
    {
        $this->_manager = $manager;
    }
        
    public function Read($justthese, $filter)
    {
        $this->_ldapconn = ldap_connect($this->_ldapuri);
    
        ldap_set_option($this->_ldapconn, LDAP_OPT_PROTOCOL_VERSION, 3);

        $sr = ldap_search($this->_ldapconn, $this->_dn, $filter , $justthese);
        $info = ldap_get_entries($this->_ldapconn, $sr);
        return $info;
    }
    
    public function search_existant($nom, $prenom, $group)
    {
        $search = $this->_manager->getDb("*","surname='$nom' AND firstname='$prenom' AND class='$group'");
        $count = 0;
        foreach($search as $search){
            $count++;
        }
        if($count === 0) {
            return false;
        }
        else{
            return true;
        }
    }

	public function insertUser($selectedGroup)
	{
	    $filter="(&(|(objectclass=inetOrgPerson))(|(memberof=" . $selectedGroup . ")))";
        $justthese = ["uid"];
        $info = $this->Read($justthese , $filter);
        $cpt = 0;
//echo "<script>console.log(" . json_encode($info, JSON_HEX_TAG) . ")</script>";

        $posCN = strpos($selectedGroup, 'cn=');
        $posVIRG = strpos($selectedGroup, ',' ,$posCN);
        //Groupe
        $group = substr($selectedGroup , $posCN + 3 , $posVIRG - $posCN - 3);
//echo "<script>console.log(" . json_encode($group, JSON_HEX_TAG) . ")</script>";


        while($info["count"] > $cpt){
            $donnees['surname']  = $info[$cpt]["uid"][0];
            $donnees['firstname']  = $info[$cpt]["uid"][0];
            $donnees['class'] = $group;
            $donnees['ldap'] = true;

            if($this->search_existant($donnees['surname'], $donnees['firstname'], $donnees['class']) != true)
            {
                $object = new Student($donnees);
                $this->_manager->add($object);
            }

            $cpt++;
        }
    }
    
    public function groups($exist)
    {
        $filter="(|(objectClass=posixGroup))";
        $justthese = ["cn"];

        $cpt = 0;
        $info = $this->Read($justthese , $filter);

//echo "<script>console.log(" . json_encode($info, JSON_HEX_TAG) . ")</script>";

        while($info["count"] > $cpt){
            //tester $exist et tester si exist dans la base
            $classe = $this->_manager->getDb("DISTINCT class");
            $test = false;
            foreach($classe as $element){
                if($element['class'] === $info[$cpt]["cn"][0]){
                    $test = true;
                }
            }
            if($exist === $test){
                echo  "<option value='". $info[$cpt]["dn"] ."'>" . $info[$cpt]["cn"][0] . "</option>" ;
            }

            $cpt++;
        }  
    }
}

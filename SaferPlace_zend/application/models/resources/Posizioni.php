<?php
class Application_Resource_Posizioni extends  Zend_Db_Table_Abstract
{
    protected  $_name='posizione';
    protected $_rowClass='Application_Resource_Piani_Item';
    protected $_sequence = true;

    /**
     * dati il numero del piano e la stanza restituisce l'id della posizione dell'utente
     * @param $numPiano
     * @param $stanza
     * @return Zend_Db_Table_Rowset_Abstract
     */
    public function getIdPosizioniBynumPianoStanzaEdificio($numPiano,$stanza,$edificio){

        $select=new Application_Resource_Piani_Item();
        $select=$this->select('id')
                     ->where('numPiano='.$numPiano.' and stanza='. $stanza.' and edificio= \''. $edificio.'\'');
        return  $this->fetchAll($select);

    }

    public function existsPosizione($numPiano,$stanza,$edificio)
    {
        $select=new Application_Resource_Piani_Item();
        $select=$this->select('id')
            ->where('numPiano='.$numPiano.' and stanza='. $stanza.' and edificio= \''. $edificio.'\'');

        $risultato = $this->getAdapter()->query($select);

        if($risultato->rowCount()==0)
            $controllo = false;
        else $controllo = true;
        return $controllo;
    }

    public function getStanzeBynumPianoEdificio($numPiano,$edificio){

        $select=new Application_Resource_Piani_Item();
        $select=$this->select('id')
            ->where('numPiano='.$numPiano.' and edificio= \''. $edificio.'\'');
        return  $this->fetchAll($select);

    }

    public function getPosizioniById($id){

        $select=new Application_Resource_Piani_Item();
        $select=$this->select()
            ->where('id=?',$id);
        return  $this->fetchAll($select);

    }

    /**
     * inserisce nel db la posizione dell'utente
     * @param $zona
     * @param $stanza
     * @param $numPiano
     * @param  $edificio
     */
    public function insertPosizione($zona,$stanza,$numPiano, $edificio)
    {
        $posizioni = array(
            'zona'      => $zona,
            'stanza'    => $stanza,
            'numPiano'      => $numPiano,
            'edificio'      => $edificio
        );
        
        $this->insert($posizioni);
    }

    public function delByZona($idzona){

        $del =$this->getAdapter()->quoteInto('zona = ?', $idzona);

        $this->delete($del);
    }

    public function getPosizioniBynumPianoEdificio($numPiano,$edificio){

        $select=$this->select()
            ->where('numPiano='.$numPiano.' and edificio= \''. $edificio.'\'');
        return  $this->fetchAll($select);

    }

    public function delPosizioni($id)
    {
        $del = $this->getAdapter()->quoteInto('id = ?', $id);
        $this->delete($del);
    }

    public function agiornaPosizioniByEdificio($nomeEdificio,$data){

        $where = "edificio ='$nomeEdificio'";
        $this->getAdapter()->update('posizione',$data,$where);

    }
    
}


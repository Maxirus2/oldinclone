<?php

namespace ProjectBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Fixture
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class torgFixture
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
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=500)
     */
    private $name;
    
    
    /**
     * @var integer
     *
     * @ORM\Column(name="power", type="integer")
     */
    private $power;
    
    /**
     * @ORM\Column(name="type", type="string")
     */
    private $type;
    
    
    /**
     * @var double
     *
     * @ORM\Column(name="lightflow", type="float")
     */
    private $lightflow;
    
     /**
     * @var string
     *
     * @ORM\Column(name="appointmentTwo", type="string")
     */
    private $appointmentTwo;
    
     /**
     * @var string
     *
     * @ORM\Column(name="degreeprotection", type="integer")
     */
    private $degreeprotection;

    /**
     * @var string
     *
     * @ORM\Column(name="sumsvetpotok", type="string")
     */
    private $sumsvetpotok;
    
    /**
     * @var string
     *
     * @ORM\Column(name="preddiapazonvhodnih", type="string")
     */
    private $preddiapazonvhodnih;
    
    /**
     * @var string
     *
     * @ORM\Column(name="koefpulsatsiy", type="string")
     */
    private $koefpulsatsiy;
    
    /**
     * @var string
     *
     * @ORM\Column(name="markasvetodioda", type="string")
     */
    private $markasvetodioda;
    
    /**
     * @var string
     *
     * @ORM\Column(name="kolvosvetodiodov", type="string")
     */
    private $kolvosvetodiodov;
    
    /**
     * @var string
     *
     * @ORM\Column(name="rabresurssvetodiodov", type="string")
     */
    private $rabresurssvetodiodov;
    
    /**
     * @var string
     *
     * @ORM\Column(name="rabtoksvetodiodov", type="string")
     */
    private $rabtoksvetodiodov;
    
    /**
     * @var string
     *
     * @ORM\Column(name="svetpotokodnogo", type="string")
     */
    private $svetpotokodnogo;
    
    /**
     * @var string
     *
     * @ORM\Column(name="kriviesilisveta", type="string")
     */
    private $kriviesilisveta;
    
    /**
     * @var string
     *
     * @ORM\Column(name="tsvetovayatemp", type="string")
     */
    private $tsvetovayatemp;
    
    /**
     * @var string
     *
     * @ORM\Column(name="indextsvetoperedachi", type="string")
     */
    private $indextsvetoperedachi;
    
    /**
     * @var string
     *
     * @ORM\Column(name="vremyavklucheniya", type="string")
     */
    private $vremyavklucheniya;
    
    /**
     * @var string
     *
     * @ORM\Column(name="materialrasseivatelya", type="string")
     */
    private $materialrasseivatelya;
    
    /**
     * @var string
     *
     * @ORM\Column(name="kolvoistochnikov", type="string")
     */
    private $kolvoistochnikov;
    
    /**
     * @var string
     *
     * @ORM\Column(name="materialmontajnihplat", type="string")
     */
    private $materialmontajnihplat;
    
    /**
     * @var string
     *
     * @ORM\Column(name="materialkorpusa", type="string")
     */
    private $materialkorpusa;
    
    /**
     * @var string
     *
     * @ORM\Column(name="sposopkrepleniya", type="string")
     */
    private $sposopkrepleniya;
    
    /**
     * @var string
     *
     * @ORM\Column(name="klasszashitiottoka", type="string")
     */
    private $klasszashitiottoka;
    
    /**
     * @var string
     *
     * @ORM\Column(name="temperaturaekspluataciy", type="string")
     */
    private $temperaturaekspluataciy;
    
    /**
     * @var string
     *
     * @ORM\Column(name="garantiya", type="string")
     */
    private $garantiya;
    
    /**
     * @var string
     *
     * @ORM\Column(name="proizvoditelistochnikapitaniya", type="string")
     */
    private $proizvoditelistochnikapitaniya;
    
    /**
     * @var string
     *
     * @ORM\Column(name="model", type="string")
     */
    private $model;
    
    /**
     * @var string
     *
     * @ORM\Column(name="grozozashita", type="string")
     */
    private $grozozashita;
    
    /**
     * @var string
     *
     * @ORM\Column(name="termozashita", type="string")
     */
    private $termozashita;
    
    /**
     * @var string
     *
     * @ORM\Column(name="zashitaot380", type="string")
     */
    private $zashitaot380;
    
    /**
     * @var 
     *
     * @ORM\Column(name="zashitaotKorotkogozamika", type="string")
     */
    private $zashitaotKorotkogozamika;
    
    /**
     * @var 
     *
     * @ORM\Column(name="zashitaOtholostogoHoda", type="string")
     */
    private $zashitaOtholostogoHoda;
    
    /**
     * @var 
     *
     * @ORM\Column(name="previshenievihnapryaz", type="string")
     */
    private $previshenievihnapryaz;
    
    /**
     * @var 
     *
     * @ORM\Column(name="napryazeniepitaniya", type="string")
     */
    private $napryazeniepitaniya;
    
    /**
     * @var string
     *
     * @ORM\Column(name="chastota", type="string", length=320)
     */
    private $chastota;
    
    /**
     * @var 
     *
     * @ORM\Column(name="koefpower", type="string")
     */
    private $koefpower;
    
    /**
     * @var 
     *
     * @ORM\Column(name="stepenzahistiIstochnikapitaniya", type="string")
     */
    private $stepenzahistiIstochnikapitaniya;
    
    /**
     * @var 
     *
     * @ORM\Column(name="elektromagnitnayasovmest", type="string")
     */
    private $elektromagnitnayasovmest;
    
    /**
     * @var 
     *
     * @ORM\Column(name="galvanicheskIzol", type="string")
     */
    private $galvanicheskIzol;
    /**
     * @var 
     *
     * @ORM\Column(name="probivnoeNapryajenie", type="string")
     */
    private $probivnoeNapryajenie;
    
    /**
     * @var 
     *
     * @ORM\Column(name="soprotivlenieIzolatsii", type="string")
     */
    private $soprotivlenieIzolatsii;
    
    /**
     * @var 
     *
     * @ORM\Column(name="gabariti", type="string")
     */
    private $gabariti;
    
    /**
     * @var 
     *
     * @ORM\Column(name="massanetto", type="string")
     */
    private $massanetto;
    
    /**
     * @var 
     *
     * @ORM\Column(name="kolvovKorobke", type="string")
     */
    private $kolvovKorobke;
    
    /**
     * @var 
     *
     * @ORM\Column(name="gabaritiKorobki", type="string")
     */
    private $gabaritiKorobki;
    
    /**
     * @var 
     *
     * @ORM\Column(name="obiomkorobki", type="string")
     */
    private $obiomkorobki;
    
    /**
     * @var 
     *
     * @ORM\Column(name="massaBrutto", type="string")
     */
    private $massaBrutto;
    
    /**
     * @var 
     *
     * @ORM\Column(name="vidKlimatichispol", type="string")
     */
    private $vidKlimatichispol;
    
    /**
     * @var 
     *
     * @ORM\Column(name="klassopasnosti", type="string")
     */
    private $klassopasnosti;
    
    /**
     * @var 
     *
     * @ORM\Column(name="indexEnergoeffect", type="string")
     */
    private $indexEnergoeffect;
    
    /**
     * @var 
     *
     * @ORM\Column(name="ploshadTeplootvodPoverhn", type="string")
     */
    private $ploshadTeplootvodPoverhn;
    
    /**
     * @var 
     *
     * @ORM\Column(name="teplovidelenie", type="string")
     */
    private $teplovidelenie;

    /**
     * @var string
     *
     * @ORM\Column(name="fullDesc", type="string", length=6000)
     */
    private $fullDesc;
    
    /**
     * @var string
     *
     * @ORM\Column(name="shortDesc", type="string", length=340)
     */
    private $shortDesc;

    /**
     * @var string
     *
     * @ORM\Column(name="picture", type="string", length=1300)
     */
    private $picture;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createdAt", type="datetime")
     */
    private $createdAt;


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
     * Set name
     *
     * @param string $name
     *
     * @return Fixture
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }
    
    public function getPower() {
        return $this->power;
    }

    public function getLightflow() {
        return $this->lightflow;
    }

    public function getDegreeprotection() {
        return $this->degreeprotection;
    }

    public function setPower($power) {
        $this->power = $power;
    }

    public function setLightflow($lightflow) {
        $this->lightflow = $lightflow;
    }
    
    public function getPrevishenievihnapryaz() {
        return $this->previshenievihnapryaz;
    }

    public function getNapryazeniepitaniya() {
        return $this->napryazeniepitaniya;
    }
    
    public function getPreddiapazonvhodnih() {
        return $this->preddiapazonvhodnih;
    }

    public function setPreddiapazonvhodnih($preddiapazonvhodnih) {
        $this->preddiapazonvhodnih = $preddiapazonvhodnih;
    }

        public function setPrevishenievihnapryaz($previshenievihnapryaz) {
        $this->previshenievihnapryaz = $previshenievihnapryaz;
    }

    public function setNapryazeniepitaniya($napryazeniepitaniya) {
        $this->napryazeniepitaniya = $napryazeniepitaniya;
    }
    
    public function setType($type) {
        $this->type = $type;
    }

    public function getType() {
        return $this->type;
    }

    public function setDegreeprotection($degreeprotection) {
        $this->degreeprotection = $degreeprotection;
    }

        /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set shortDesc
     *
     * @param string $shortDesc
     *
     * @return Fixture
     */
    public function setShortDesc($shortDesc)
    {
        $this->shortDesc = $shortDesc;

        return $this;
    }
    
    public function getAppointmentTwo() {
        return $this->appointmentTwo;
    }

    public function setAppointmentTwo($appointmentTwo) {
        $this->appointmentTwo = $appointmentTwo;
    }

        /**
     * Get shortDesc
     *
     * @return string
     */
    public function getShortDesc()
    {
        return $this->shortDesc;
    }

    /**
     * Set fullDesc
     *
     * @param string $fullDesc
     *
     * @return Fixture
     */
    public function setFullDesc($fullDesc)
    {
        $this->fullDesc = $fullDesc;

        return $this;
    }
    
    public function getSumsvetpotok() {
        return $this->sumsvetpotok;
    }

    public function getKoefpulsatsiy() {
        return $this->koefpulsatsiy;
    }

    public function getMarkasvetodioda() {
        return $this->markasvetodioda;
    }

    public function getKolvosvetodiodov() {
        return $this->kolvosvetodiodov;
    }

    public function getRabresurssvetodiodov() {
        return $this->rabresurssvetodiodov;
    }

    public function getRabtoksvetodiodov() {
        return $this->rabtoksvetodiodov;
    }

    public function getSvetpotokodnogo() {
        return $this->svetpotokodnogo;
    }

    public function getKriviesilisveta() {
        return $this->kriviesilisveta;
    }

    public function getTsvetovayatemp() {
        return $this->tsvetovayatemp;
    }

    public function getIndextsvetoperedachi() {
        return $this->indextsvetoperedachi;
    }

    public function getVremyavklucheniya() {
        return $this->vremyavklucheniya;
    }

    public function getMaterialrasseivatelya() {
        return $this->materialrasseivatelya;
    }

    public function getKolvoistochnikov() {
        return $this->kolvoistochnikov;
    }

    public function getMaterialmontajnihplat() {
        return $this->materialmontajnihplat;
    }

    public function getMaterialkorpusa() {
        return $this->materialkorpusa;
    }

    public function getSposopkrepleniya() {
        return $this->sposopkrepleniya;
    }

    public function getKlasszashitiottoka() {
        return $this->klasszashitiottoka;
    }

    public function getTemperaturaekspluataciy() {
        return $this->temperaturaekspluataciy;
    }

    public function getGarantiya() {
        return $this->garantiya;
    }

    public function getProizvoditelistochnikapitaniya() {
        return $this->proizvoditelistochnikapitaniya;
    }

    public function getModel() {
        return $this->model;
    }

    public function getGrozozashita() {
        return $this->grozozashita;
    }

    public function getTermozashita() {
        return $this->termozashita;
    }

    public function getZashitaot380() {
        return $this->zashitaot380;
    }

    public function getZashitaotKorotkogozamika() {
        return $this->zashitaotKorotkogozamika;
    }

    public function getZashitaOtholostogoHoda() {
        return $this->zashitaOtholostogoHoda;
    }


    public function getChastota() {
        return $this->chastota;
    }

    public function getKoefpower() {
        return $this->koefpower;
    }

    public function getStepenzahistiIstochnikapitaniya() {
        return $this->stepenzahistiIstochnikapitaniya;
    }

    public function getElektromagnitnayasovmest() {
        return $this->elektromagnitnayasovmest;
    }

    public function getGalvanicheskIzol() {
        return $this->galvanicheskIzol;
    }

    public function getProbivnoeNapryajenie() {
        return $this->probivnoeNapryajenie;
    }

   public function getSoprotivlenieIzolatsii() {
        return $this->soprotivlenieIzolatsii;
    }

    public function getGabariti() {
        return $this->gabariti;
    }

    public function getMassanetto() {
        return $this->massanetto;
    }

    public function getKolvovKorobke() {
        return $this->kolvovKorobke;
    }

    public function getGabaritiKorobki() {
        return $this->gabaritiKorobki;
    }

    public function getObiomkorobki() {
        return $this->obiomkorobki;
    }

    public function getMassaBrutto() {
        return $this->massaBrutto;
    }

    public function getVidKlimatichispol() {
        return $this->vidKlimatichispol;
    }

    public function getKlassopasnosti() {
        return $this->klassopasnosti;
    }

    public function getIndexEnergoeffect() {
        return $this->indexEnergoeffect;
    }

    public function getPloshadTeplootvodPoverhn() {
        return $this->ploshadTeplootvodPoverhn;
    }

    public function getTeplovidelenie() {
        return $this->teplovidelenie;
    }

    public function setSumsvetpotok( $sumsvetpotok) {
        $this->sumsvetpotok = $sumsvetpotok;
    }

    public function setKoefpulsatsiy( $koefpulsatsiy) {
        $this->koefpulsatsiy = $koefpulsatsiy;
    }

    public function setMarkasvetodioda( $markasvetodioda) {
        $this->markasvetodioda = $markasvetodioda;
    }

    public function setKolvosvetodiodov( $kolvosvetodiodov) {
        $this->kolvosvetodiodov = $kolvosvetodiodov;
    }

    public function setRabresurssvetodiodov( $rabresurssvetodiodov) {
        $this->rabresurssvetodiodov = $rabresurssvetodiodov;
    }

    public function setRabtoksvetodiodov( $rabtoksvetodiodov) {
        $this->rabtoksvetodiodov = $rabtoksvetodiodov;
    }

    public function setSvetpotokodnogo( $svetpotokodnogo) {
        $this->svetpotokodnogo = $svetpotokodnogo;
    }

    public function setKriviesilisveta( $kriviesilisveta) {
        $this->kriviesilisveta = $kriviesilisveta;
    }

    public function setTsvetovayatemp( $tsvetovayatemp) {
        $this->tsvetovayatemp = $tsvetovayatemp;
    }

    public function setIndextsvetoperedachi( $indextsvetoperedachi) {
        $this->indextsvetoperedachi = $indextsvetoperedachi;
    }

    public function setVremyavklucheniya( $vremyavklucheniya) {
        $this->vremyavklucheniya = $vremyavklucheniya;
    }

    public function setMaterialrasseivatelya( $materialrasseivatelya) {
        $this->materialrasseivatelya = $materialrasseivatelya;
    }

    public function setKolvoistochnikov( $kolvoistochnikov) {
        $this->kolvoistochnikov = $kolvoistochnikov;
    }

    public function setMaterialmontajnihplat( $materialmontajnihplat) {
        $this->materialmontajnihplat = $materialmontajnihplat;
    }

    public function setMaterialkorpusa( $materialkorpusa) {
        $this->materialkorpusa = $materialkorpusa;
    }

    public function setSposopkrepleniya( $sposopkrepleniya) {
        $this->sposopkrepleniya = $sposopkrepleniya;
    }

    public function setKlasszashitiottoka( $klasszashitiottoka) {
        $this->klasszashitiottoka = $klasszashitiottoka;
    }

    public function setTemperaturaekspluataciy( $temperaturaekspluataciy) {
        $this->temperaturaekspluataciy = $temperaturaekspluataciy;
    }

    public function setGarantiya( $garantiya) {
        $this->garantiya = $garantiya;
    }

    public function setProizvoditelistochnikapitaniya( $proizvoditelistochnikapitaniya) {
        $this->proizvoditelistochnikapitaniya = $proizvoditelistochnikapitaniya;
    }

    public function setModel( $model) {
        $this->model = $model;
    }

    public function setGrozozashita( $grozozashita) {
        $this->grozozashita = $grozozashita;
    }

    public function setTermozashita( $termozashita) {
        $this->termozashita = $termozashita;
    }

    public function setZashitaot380( $zashitaot380) {
        $this->zashitaot380 = $zashitaot380;
    }

    public function setZashitaotKorotkogozamika( $zashitaotKorotkogozamika) {
        $this->zashitaotKorotkogozamika = $zashitaotKorotkogozamika;
    }

    public function setZashitaOtholostogoHoda( $zashitaOtholostogoHoda) {
        $this->zashitaOtholostogoHoda = $zashitaOtholostogoHoda;
    }


    public function setChastota($chastota) {
        $this->chastota = $chastota;
    }

    public function setKoefpower( $koefpower) {
        $this->koefpower = $koefpower;
    }

    public function setStepenzahistiIstochnikapitaniya( $stepenzahistiIstochnikapitaniya) {
        $this->stepenzahistiIstochnikapitaniya = $stepenzahistiIstochnikapitaniya;
    }

    public function setElektromagnitnayasovmest( $elektromagnitnayasovmest) {
        $this->elektromagnitnayasovmest = $elektromagnitnayasovmest;
    }

    public function setGalvanicheskIzol( $galvanicheskIzol) {
        $this->galvanicheskIzol = $galvanicheskIzol;
    }

    public function setProbivnoeNapryajenie( $probivnoeNapryajenie) {
        $this->probivnoeNapryajenie = $probivnoeNapryajenie;
    }

    public function setSoprotivlenieIzolatsii( $soprotivlenieIzolatsii) {
        $this->soprotivlenieIzolatsii = $soprotivlenieIzolatsii;
    }

    public function setGabariti( $gabariti) {
        $this->gabariti = $gabariti;
    }

    public function setMassanetto( $massanetto) {
        $this->massanetto = $massanetto;
    }

    public function setKolvovKorobke( $kolvovKorobke) {
        $this->kolvovKorobke = $kolvovKorobke;
    }

    public function setGabaritiKorobki( $gabaritiKorobki) {
        $this->gabaritiKorobki = $gabaritiKorobki;
    }

    public function setObiomkorobki( $obiomkorobki) {
        $this->obiomkorobki = $obiomkorobki;
    }

    public function setMassaBrutto( $massaBrutto) {
        $this->massaBrutto = $massaBrutto;
    }

    public function setVidKlimatichispol( $vidKlimatichispol) {
        $this->vidKlimatichispol = $vidKlimatichispol;
    }

    public function setKlassopasnosti( $klassopasnosti) {
        $this->klassopasnosti = $klassopasnosti;
    }

    public function setIndexEnergoeffect( $indexEnergoeffect) {
        $this->indexEnergoeffect = $indexEnergoeffect;
    }

    public function setPloshadTeplootvodPoverhn( $ploshadTeplootvodPoverhn) {
        $this->ploshadTeplootvodPoverhn = $ploshadTeplootvodPoverhn;
    }

    public function setTeplovidelenie( $teplovidelenie) {
        $this->teplovidelenie = $teplovidelenie;
    }

    /**
     * Get fullDesc
     *
     * @return string
     */
    public function getFullDesc()
    {
        return $this->fullDesc;
    }

    /**
     * Set picture
     *
     * @param string $picture
     *
     * @return Fixture
     */
    public function setPicture($picture)
    {
        $this->picture = $picture;

        return $this;
    }

    /**
     * Get picture
     *
     * @return string
     */
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Fixture
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }
}

<?php

namespace ProjectBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller {

    /**
     * @Route("/", name="home")
     */
    public function indexAction() {
        return $this->render('ProjectBundle:Default:layout.html.twig');
    }

    /**
     * @Route("/partners", name="partners")
     */
    public function listpartnersAction() {
        return $this->render('ProjectBundle:Default:partners.html.twig');
    }

    /**
     * @Route("/info", name="info")
     */
    public function listInfoAction() {
        $articles = $this->getDoctrine()->getRepository('ProjectBundle:Article')
                ->findAll();
        return $this->render('ProjectBundle:Default:information.html.twig', array(''
                    . 'article' => $articles));
    }

    /**
     * @Route("/info/{id}", name="fullinfo")
     */
    public function listFullInfoAction($id) {

        $articles = $this->getDoctrine()->getRepository('ProjectBundle:Article')
                ->findBy(array('id' => $id));
        if (!$articles) {
            return $this->redirectToRoute('home');
        }
        return $this->render('ProjectBundle:Default:article.html.twig', array(''
                    . 'article' => $articles));
    }

    /**
     * @Route("/contacts", name="contacts")
     */
    public function listContactsActiom() {
        return $this->render('ProjectBundle:Default:contacts.html.twig');
    }

    /**
     * @Route("/fixtures", name="findaction")
     */
    public function listFixturesAction(Request $request) {

        $promFixture = $request->get('prom');
        $officeFixture = $request->get('office');
        $torgFixture = $request->get('torg');
        $streetFixture = $request->get('street');
        $fitoFixture = $request->get('fito');
        $azsFixture = $request->get('azs');
        $power144 = $request->get('144');
        $power4589 = $request->get('4589');
        $power90199 = $request->get('90199');
        $power2001000 = $request->get('2001000');
        $stepdo5ip = $request->get('do50ip');
        $stepdo5167ip = $request->get('do5167ip');
        $stepdo6888ip = $request->get('do6888ip');
        $vstraivaemie = $request->get('vstraivaemie');
        $nakladnie = $request->get('nakladnie');
        $ulichnie = $request->get('ulichnie');
        $podvesnie = $request->get('podvesnie');
        $potolochnie = $request->get('potolochnie');
        $nastennie = $request->get('nastennie');
        $sdatchikom = $request->get('sdatchikom');

        $inputFields = array($promFixture, $officeFixture, $torgFixture, $streetFixture, $fitoFixture, $azsFixture,
            $power144, $power4589, $power90199, $power2001000, $stepdo5ip, $stepdo5167ip, $stepdo6888ip, $vstraivaemie,
            $nakladnie, $ulichnie, $podvesnie, $potolochnie, $nastennie, $sdatchikom);						
        $promfixtures = $this->getDoctrine()->getRepository('ProjectBundle:promFixture')
                ->findAll();
        $officefixtures = $this->getDoctrine()->getRepository('ProjectBundle:officeFixture')
                ->findAll();
        $torgfixtures = $this->getDoctrine()->getRepository('ProjectBundle:torgFixture')
                ->findAll();
        $streetfixtures = $this->getDoctrine()->getRepository('ProjectBundle:streetFixture')
                ->findAll();
        $fitofixtures = $this->getDoctrine()->getRepository('ProjectBundle:fitoFixture')
                ->findAll();
        $azsfixtures = $this->getDoctrine()->getRepository('ProjectBundle:azsFixture')
                ->findAll();


        $em = $this->getDoctrine()->getManager();
        if (isset($_POST['4589'])) {			if (isset($_POST['prom'])) {				            $searchByPowerProm = $em->createQuery(                    'SELECT p    FROM ProjectBundle:promFixture p    WHERE p.power BETWEEN 45 and 89');            $resPowerProm = $searchByPowerProm->getResult();			}			if (isset($_POST['office'])) {				$searchByPowerOffice = $em->createQuery(                    'SELECT p    FROM ProjectBundle:officeFixture p    WHERE p.power BETWEEN 45 and 89');            $resPowerOffice = $searchByPowerOffice->getResult();			}			if (isset($_POST['torg'])){			 $searchByPowerTorg = $em->createQuery(                    'SELECT p    FROM ProjectBundle:torgFixture p    WHERE p.power BETWEEN 45 and 89');            $resPowerTorg = $searchByPowerTorg->getResult();			}            if (isset($_POST['street'])){				$searchByPowerStreet = $em->createQuery(                    'SELECT p    FROM ProjectBundle:streetFixture p    WHERE p.power BETWEEN 45 and 89');            $resPowerStreet = $searchByPowerStreet->getResult();			}            if (isset($_POST['fito'])){				$searchByPowerFito = $em->createQuery(                    'SELECT p    FROM ProjectBundle:fitoFixture p    WHERE p.power BETWEEN 45 and 89');            $resPowerFito = $searchByPowerFito->getResult();			}			 if (isset($_POST['azs'])){	$searchByPowerAzs = $em->createQuery(                    'SELECT p    FROM ProjectBundle:azsFixture p    WHERE p.power BETWEEN 45 and 89');            $resPowerAzs = $searchByPowerAzs->getResult();			 }
            
            $count = count($resPowerProm) + count($resPowerOffice) + count($resPowerTorg) + count($resPowerStreet) + count($resPowerFito) + count($resPowerAzs);
            return $this->render('ProjectBundle:Default:fixtures.html.twig', array(''
                        . 'resPowerProm' => $resPowerProm, ''
                        . 'resPowerOffce' => $resPowerOffice, ''
                        . 'resPowerTorg' => $resPowerTorg, ''
                        . 'resPowerStreet' => $resPowerStreet, ''
                        . 'resPowerFito' => $resPowerFito, ''
                        . 'resPowerAzs' => $resPowerAzs, ''
                        . 'count' => $count, ''
                        . 'inputFielsd' => $inputFields));
        }

        if (isset($_POST['144'])) {
            $searchByPowerProm = $em->createQuery(
                    'SELECT p
    FROM ProjectBundle:promFixture p
    WHERE p.power BETWEEN 1 and 44');
            $resPowerProm = $searchByPowerProm->getResult();
            $searchByPowerOffice = $em->createQuery(
                    'SELECT p
    FROM ProjectBundle:officeFixture p
    WHERE p.power BETWEEN 1 and 44');
            $resPowerOffice = $searchByPowerOffice->getResult();
            $searchByPowerTorg = $em->createQuery(
                    'SELECT p
    FROM ProjectBundle:torgFixture p
    WHERE p.power BETWEEN 1 and 44');
            $resPowerTorg = $searchByPowerTorg->getResult();
            $searchByPowerStreet = $em->createQuery(
                    'SELECT p
    FROM ProjectBundle:streetFixture p
    WHERE p.power BETWEEN 1 and 44');
            $resPowerStreet = $searchByPowerStreet->getResult();
            $searchByPowerFito = $em->createQuery(
                    'SELECT p
    FROM ProjectBundle:fitoFixture p
    WHERE p.power BETWEEN 1 and 44');
            $resPowerFito = $searchByPowerFito->getResult();
            $searchByPowerAzs = $em->createQuery(
                    'SELECT p
    FROM ProjectBundle:azsFixture p
    WHERE p.power BETWEEN 1 and 44');
            $resPowerAzs = $searchByPowerAzs->getResult();
            $count = count($resPowerProm) + count($resPowerOffice) + count($resPowerTorg) + count($resPowerStreet) + count($resPowerFito) + count($resPowerAzs);
            return $this->render('ProjectBundle:Default:fixtures.html.twig', array(''
                        . 'resPowerProm' => $resPowerProm, ''
                        . 'resPowerOffice' => $resPowerOffice, ''
                        . 'resPowerTorg' => $resPowerTorg, ''
                        . 'resPowerStreet' => $resPowerStreet, ''
                        . 'resPowerFito' => $resPowerFito, ''
                        . 'resPowerAzs' => $resPowerAzs, ''
                        . 'count' => $count, ''
                        . 'inputFielsd' => $inputFields));
        }

        if (isset($_POST['90199'])) {
            $searchByPowerProm = $em->createQuery(
                    'SELECT p
    FROM ProjectBundle:promFixture p
    WHERE p.power BETWEEN 90 and 199');
            $resPowerProm = $searchByPowerProm->getResult();
            $searchByPowerOffice = $em->createQuery(
                    'SELECT p
    FROM ProjectBundle:officeFixture p
    WHERE p.power BETWEEN 90 and 199');
            $resPowerOffice = $searchByPowerOffice->getResult();
            $searchByPowerTorg = $em->createQuery(
                    'SELECT p
    FROM ProjectBundle:torgFixture p
    WHERE p.power BETWEEN 90 and 199');
            $resPowerTorg = $searchByPowerTorg->getResult();
            $searchByPowerStreet = $em->createQuery(
                    'SELECT p
    FROM ProjectBundle:streetFixture p
    WHERE p.power BETWEEN 90 and 199');
            $resPowerStreet = $searchByPowerStreet->getResult();
            $searchByPowerFito = $em->createQuery(
                    'SELECT p
    FROM ProjectBundle:fitoFixture p
    WHERE p.power BETWEEN 90 and 199');
            $resPowerFito = $searchByPowerFito->getResult();
            $searchByPowerAzs = $em->createQuery(
                    'SELECT p
    FROM ProjectBundle:azsFixture p
    WHERE p.power BETWEEN 90 and 199');
            $resPowerAzs = $searchByPowerAzs->getResult();
            $count = count($resPowerProm) + count($resPowerOffice) + count($resPowerTorg) + count($resPowerStreet) + count($resPowerFito) + count($resPowerAzs);
            return $this->render('ProjectBundle:Default:fixtures.html.twig', array(''
                        . 'resPowerProm' => $resPowerProm, ''
                        . 'resPowerOffice' => $resPowerOffice, ''
                        . 'resPowerTorg' => $resPowerTorg, ''
                        . 'resPowerStreet' => $resPowerStreet, ''
                        . 'resPowerFito' => $resPowerFito, ''
                        . 'resPowerAzs' => $resPowerAzs, ''
                        . 'count' => $count, ''
                        . 'inputFielsd' => $inputFields));
        }

        if (isset($_POST['2001000'])) {
            $searchByPowerProm = $em->createQuery(
                    'SELECT p
    FROM ProjectBundle:promFixture p
    WHERE p.power BETWEEN 200 and 1000');
            $resPowerProm = $searchByPowerProm->getResult();
            $searchByPowerOffice = $em->createQuery(
                    'SELECT p
    FROM ProjectBundle:officeFixture p
    WHERE p.power BETWEEN 200 and 1000');
            $resPowerOffice = $searchByPowerOffice->getResult();
            $searchByPowerTorg = $em->createQuery(
                    'SELECT p
    FROM ProjectBundle:torgFixture p
    WHERE p.power BETWEEN 200 and 1000');
            $resPowerTorg = $searchByPowerTorg->getResult();
            $searchByPowerStreet = $em->createQuery(
                    'SELECT p
    FROM ProjectBundle:streetFixture p
    WHERE p.power BETWEEN 200 and 1000');
            $resPowerStreet = $searchByPowerStreet->getResult();
            $searchByPowerFito = $em->createQuery(
                    'SELECT p
    FROM ProjectBundle:fitoFixture p
    WHERE p.power BETWEEN 200 and 1000');
            $resPowerFito = $searchByPowerFito->getResult();
            $searchByPowerAzs = $em->createQuery(
                    'SELECT p
    FROM ProjectBundle:azsFixture p
    WHERE p.power BETWEEN 200 and 1000');
            $resPowerAzs = $searchByPowerAzs->getResult();
            $count = count($resPowerProm) + count($resPowerOffice) + count($resPowerTorg) + count($resPowerStreet) + count($resPowerFito) + count($resPowerAzs);
            return $this->render('ProjectBundle:Default:fixtures.html.twig', array(''
                        . 'resPowerProm' => $resPowerProm, ''
                        . 'resPowerOffice' => $resPowerOffice, ''
                        . 'resPowerTorg' => $resPowerTorg, ''
                        . 'resPowerStreet' => $resPowerStreet, ''
                        . 'resPowerFito' => $resPowerFito, ''
                        . 'resPowerAzs' => $resPowerAzs, ''
                        . 'count' => $count, ''
                        . 'inputFielsd' => $inputFields));
        }
        if (isset($_POST['do50ip'])) {
            $searchByIpProm = $em->createQuery(
                    'SELECT p
    FROM ProjectBundle:promFixture p
    WHERE p.degreeprotection BETWEEN 0 and 50');
            $resIpProm = $searchByIpProm->getResult();
            $searchByIpOffice = $em->createQuery(
                    'SELECT p
    FROM ProjectBundle:officeFixture p
    WHERE p.degreeprotection BETWEEN 0 and 50');
            $resIpOffice = $searchByIpOffice->getResult();
            $searchByIpTorg = $em->createQuery(
                    'SELECT p
    FROM ProjectBundle:torgFixture p
    WHERE p.degreeprotection BETWEEN 0 and 50');
            $resIpTorg = $searchByIpTorg->getResult();
            $searchByIpStreet = $em->createQuery(
                    'SELECT p
    FROM ProjectBundle:streetFixture p
    WHERE p.degreeprotection BETWEEN 0 and 50');
            $resIpStreet = $searchByIpStreet->getResult();
            $searchByIpFito = $em->createQuery(
                    'SELECT p
    FROM ProjectBundle:fitoFixture p
    WHERE p.degreeprotection BETWEEN 0 and 50');
            $resIpFito = $searchByIpFito->getResult();
            $searchByIpAzs = $em->createQuery(
                    'SELECT p
    FROM ProjectBundle:azsFixture p
    WHERE p.degreeprotection BETWEEN 0 and 50');
            $resIpAzs = $searchByIpAzs->getResult();
            $count = count($resIpProm) + count($resIpOffice) + count($resIpTorg) + count($resIpStreet) + count($resIpFito) + count($resIpAzs);
            return $this->render('ProjectBundle:Default:fixtures.html.twig', array(''
                        . 'resIpProm' => $resIpProm, ''
                        . 'resIpOffice' => $resIpOffice, ''
                        . 'resIpTorg' => $resIpTorg, ''
                        . 'resIpStreet' => $resIpStreet, ''
                        . 'resIpFito' => $resIpFito, ''
                        . 'resIpAzs' => $resIpAzs, ''
                        . 'count' => $count, ''
                        . 'inputFielsd' => $inputFields));
        }

        if (isset($_POST['do5167ip'])) {
            $searchByIpProm = $em->createQuery(
                    'SELECT p
    FROM ProjectBundle:promFixture p
    WHERE p.degreeprotection BETWEEN 51 and 67');
            $resIpProm = $searchByIpProm->getResult();
            $searchByIpOffice = $em->createQuery(
                    'SELECT p
    FROM ProjectBundle:officeFixture p
    WHERE p.degreeprotection BETWEEN 51 and 67');
            $resIpOffice = $searchByIpOffice->getResult();
            $searchByIpTorg = $em->createQuery(
                    'SELECT p
    FROM ProjectBundle:torgFixture p
    WHERE p.degreeprotection BETWEEN 51 and 67');
            $resIpTorg = $searchByIpTorg->getResult();
            $searchByIpStreet = $em->createQuery(
                    'SELECT p
    FROM ProjectBundle:streetFixture p
    WHERE p.degreeprotection BETWEEN 51 and 67');
            $resIpStreet = $searchByIpStreet->getResult();
            $searchByIpFito = $em->createQuery(
                    'SELECT p
    FROM ProjectBundle:fitoFixture p
    WHERE p.degreeprotection BETWEEN 51 and 67');
            $resIpFito = $searchByIpFito->getResult();
            $searchByIpAzs = $em->createQuery(
                    'SELECT p
    FROM ProjectBundle:azsFixture p
    WHERE p.degreeprotection BETWEEN 51 and 67');
            $resIpAzs = $searchByIpAzs->getResult();
            $count = count($resIpProm) + count($resIpOffice) + count($resIpTorg) + count($resIpStreet) + count($resIpFito) + count($resIpAzs);
            return $this->render('ProjectBundle:Default:fixtures.html.twig', array(''
                        . 'resIpProm' => $resIpProm, ''
                        . 'resIpOffice' => $resIpOffice, ''
                        . 'resIpTorg' => $resIpTorg, ''
                        . 'resIpStreet' => $resIpStreet, ''
                        . 'resIpFito' => $resIpFito, ''
                        . 'resIpAzs' => $resIpAzs, ''
                        . 'count' => $count, ''
                        . 'inputFielsd' => $inputFields));
        }

        if (isset($_POST['do6888ip'])) {
            $searchByIpProm = $em->createQuery(
                    'SELECT p
    FROM ProjectBundle:promFixture p
    WHERE p.degreeprotection BETWEEN 68 and 88');
            $resIpProm = $searchByIpProm->getResult();
            $searchByIpOffice = $em->createQuery(
                    'SELECT p
    FROM ProjectBundle:officeFixture p
    WHERE p.degreeprotection BETWEEN 68 and 88');
            $resIpOffice = $searchByIpOffice->getResult();
            $searchByIpTorg = $em->createQuery(
                    'SELECT p
    FROM ProjectBundle:torgFixture p
    WHERE p.degreeprotection BETWEEN 68 and 88');
            $resIpTorg = $searchByIpTorg->getResult();
            $searchByIpStreet = $em->createQuery(
                    'SELECT p
    FROM ProjectBundle:streetFixture p
    WHERE p.degreeprotection BETWEEN 68 and 88');
            $resIpStreet = $searchByIpStreet->getResult();
            $searchByIpFito = $em->createQuery(
                    'SELECT p
    FROM ProjectBundle:fitoFixture p
    WHERE p.degreeprotection BETWEEN 68 and 88');
            $resIpFito = $searchByIpFito->getResult();
            $searchByIpAzs = $em->createQuery(
                    'SELECT p
    FROM ProjectBundle:azsFixture p
    WHERE p.degreeprotection BETWEEN 68 and 88');
            $resIpAzs = $searchByIpAzs->getResult();
            $count = count($resIpProm) + count($resIpOffice) + count($resIpTorg) + count($resIpStreet) + count($resIpFito) + count($resIpAzs);
            return $this->render('ProjectBundle:Default:fixtures.html.twig', array(''
                        . 'resIpProm' => $resIpProm, ''
                        . 'resIpOffice' => $resIpOffice, ''
                        . 'resIpTorg' => $resIpTorg, ''
                        . 'resIpStreet' => $resIpStreet, ''
                        . 'resIpFito' => $resIpFito, ''
                        . 'resIpAzs' => $resIpAzs, ''
                        . 'count' => $count, ''
                        . 'inputFielsd' => $inputFields));
        }

        /*         * *        Блок подвесных тип         ** */
        $resFindByTypePodvesnieProm = $this->getDoctrine()->getEntityManager()->getRepository(''
                        . 'ProjectBundle:promFixture')
                ->findBy(array('appointmentTwo' => $podvesnie));
        $resFindByTypePodvesnieOffice = $this->getDoctrine()->getEntityManager()->getRepository(''
                        . 'ProjectBundle:officeFixture')
                ->findBy(array('appointmentTwo' => $podvesnie));
        $resFindByTypePodvesnieTorg = $this->getDoctrine()->getEntityManager()->getRepository(''
                        . 'ProjectBundle:torgFixture')
                ->findBy(array('appointmentTwo' => $podvesnie));
        $resFindByTypePodvesnieStreet = $this->getDoctrine()->getEntityManager()->getRepository(''
                        . 'ProjectBundle:streetFixture')
                ->findBy(array('appointmentTwo' => $podvesnie));
        $resFindByTypePodvesnieFito = $this->getDoctrine()->getEntityManager()->getRepository(''
                        . 'ProjectBundle:fitoFixture')
                ->findBy(array('appointmentTwo' => $podvesnie));
        $resFindByTypePodvesnieAzs = $this->getDoctrine()->getEntityManager()->getRepository(''
                        . 'ProjectBundle:azsFixture')
                ->findBy(array('appointmentTwo' => $podvesnie));

        /*         * *        Блок встраиваемых тип         ** */
        $resFindByTypeVstraivaemieProm = $this->getDoctrine()->getEntityManager()->getRepository(''
                        . 'ProjectBundle:promFixture')
                ->findBy(array('appointmentTwo' => $vstraivaemie));
        $resFindByTypeVstraivaemieOffice = $this->getDoctrine()->getEntityManager()->getRepository(''
                        . 'ProjectBundle:officeFixture')
                ->findBy(array('appointmentTwo' => $vstraivaemie));
        $resFindByTypeVstraivaemieTorg = $this->getDoctrine()->getEntityManager()->getRepository(''
                        . 'ProjectBundle:torgFixture')
                ->findBy(array('appointmentTwo' => $vstraivaemie));
        $resFindByTypeVstraivaemieStreet = $this->getDoctrine()->getEntityManager()->getRepository(''
                        . 'ProjectBundle:streetFixture')
                ->findBy(array('appointmentTwo' => $vstraivaemie));
        $resFindByTypeVstraivaemieFito = $this->getDoctrine()->getEntityManager()->getRepository(''
                        . 'ProjectBundle:fitoFixture')
                ->findBy(array('appointmentTwo' => $vstraivaemie));
        $resFindByTypeVstraivaemieAzs = $this->getDoctrine()->getEntityManager()->getRepository(''
                        . 'ProjectBundle:azsFixture')
                ->findBy(array('appointmentTwo' => $vstraivaemie));

        /*         * *        Блок накладные тип         ** */
        $resFindByTypeNakladnieProm = $this->getDoctrine()->getEntityManager()->getRepository(''
                        . 'ProjectBundle:promFixture')
                ->findBy(array('appointmentTwo' => $nakladnie));
        $resFindByTypeNakladnieOffice = $this->getDoctrine()->getEntityManager()->getRepository(''
                        . 'ProjectBundle:officeFixture')
                ->findBy(array('appointmentTwo' => $nakladnie));
        $resFindByTypeNakladnieTorg = $this->getDoctrine()->getEntityManager()->getRepository(''
                        . 'ProjectBundle:torgFixture')
                ->findBy(array('appointmentTwo' => $nakladnie));
        $resFindByTypeNakladnieStreet = $this->getDoctrine()->getEntityManager()->getRepository(''
                        . 'ProjectBundle:streetFixture')
                ->findBy(array('appointmentTwo' => $nakladnie));
        $resFindByTypeNakladnieFito = $this->getDoctrine()->getEntityManager()->getRepository(''
                        . 'ProjectBundle:fitoFixture')
                ->findBy(array('appointmentTwo' => $nakladnie));
        $resFindByTypeNakladnieAzs = $this->getDoctrine()->getEntityManager()->getRepository(''
                        . 'ProjectBundle:azsFixture')
                ->findBy(array('appointmentTwo' => $nakladnie));

        /*         * *        Блок уличные тип         ** */
        $resFindByTypeUlichnieProm = $this->getDoctrine()->getEntityManager()->getRepository(''
                        . 'ProjectBundle:promFixture')
                ->findBy(array('appointmentTwo' => $ulichnie));
        $resFindByTypeUlichnieOffice = $this->getDoctrine()->getEntityManager()->getRepository(''
                        . 'ProjectBundle:officeFixture')
                ->findBy(array('appointmentTwo' => $ulichnie));
        $resFindByTypeUlichnieTorg = $this->getDoctrine()->getEntityManager()->getRepository(''
                        . 'ProjectBundle:torgFixture')
                ->findBy(array('appointmentTwo' => $ulichnie));
        $resFindByTypeUlichnieStreet = $this->getDoctrine()->getEntityManager()->getRepository(''
                        . 'ProjectBundle:streetFixture')
                ->findBy(array('appointmentTwo' => $ulichnie));
        $resFindByTypeUlichnieFito = $this->getDoctrine()->getEntityManager()->getRepository(''
                        . 'ProjectBundle:fitoFixture')
                ->findBy(array('appointmentTwo' => $ulichnie));
        $resFindByTypeUlichnieAzs = $this->getDoctrine()->getEntityManager()->getRepository(''
                        . 'ProjectBundle:azsFixture')
                ->findBy(array('appointmentTwo' => $ulichnie));

        /*         * *        Блок потолочные тип         ** */
        $resFindByTypePotolochnieProm = $this->getDoctrine()->getEntityManager()->getRepository(''
                        . 'ProjectBundle:promFixture')
                ->findBy(array('appointmentTwo' => $potolochnie));
        $resFindByTypePotolochnieOffice = $this->getDoctrine()->getEntityManager()->getRepository(''
                        . 'ProjectBundle:officeFixture')
                ->findBy(array('appointmentTwo' => $potolochnie));
        $resFindByTypePotolochnieTorg = $this->getDoctrine()->getEntityManager()->getRepository(''
                        . 'ProjectBundle:torgFixture')
                ->findBy(array('appointmentTwo' => $potolochnie));
        $resFindByTypePotolochnieStreet = $this->getDoctrine()->getEntityManager()->getRepository(''
                        . 'ProjectBundle:streetFixture')
                ->findBy(array('appointmentTwo' => $potolochnie));
        $resFindByTypePotolochnieFito = $this->getDoctrine()->getEntityManager()->getRepository(''
                        . 'ProjectBundle:fitoFixture')
                ->findBy(array('appointmentTwo' => $potolochnie));
        $resFindByTypePotolochnieAzs = $this->getDoctrine()->getEntityManager()->getRepository(''
                        . 'ProjectBundle:azsFixture')
                ->findBy(array('appointmentTwo' => $potolochnie));

        /*         * *        Блок настенные тип         ** */
        $resFindByTypeNastennieProm = $this->getDoctrine()->getEntityManager()->getRepository(''
                        . 'ProjectBundle:promFixture')
                ->findBy(array('appointmentTwo' => $nastennie));
        $resFindByTypeNastennieOffice = $this->getDoctrine()->getEntityManager()->getRepository(''
                        . 'ProjectBundle:officeFixture')
                ->findBy(array('appointmentTwo' => $nastennie));
        $resFindByTypeNastennieTorg = $this->getDoctrine()->getEntityManager()->getRepository(''
                        . 'ProjectBundle:torgFixture')
                ->findBy(array('appointmentTwo' => $nastennie));
        $resFindByTypeNastennieStreet = $this->getDoctrine()->getEntityManager()->getRepository(''
                        . 'ProjectBundle:streetFixture')
                ->findBy(array('appointmentTwo' => $nastennie));
        $resFindByTypeNastennieFito = $this->getDoctrine()->getEntityManager()->getRepository(''
                        . 'ProjectBundle:fitoFixture')
                ->findBy(array('appointmentTwo' => $nastennie));
        $resFindByTypeNastennieAzs = $this->getDoctrine()->getEntityManager()->getRepository(''
                        . 'ProjectBundle:azsFixture')
                ->findBy(array('appointmentTwo' => $nastennie));

        /*         * *        Блок с датчиком тип         ** */
        $resFindByTypeSdatchikomProm = $this->getDoctrine()->getEntityManager()->getRepository(''
                        . 'ProjectBundle:promFixture')
                ->findBy(array('appointmentTwo' => $sdatchikom));
        $resFindByTypeSdatchikomOffice = $this->getDoctrine()->getEntityManager()->getRepository(''
                        . 'ProjectBundle:officeFixture')
                ->findBy(array('appointmentTwo' => $sdatchikom));
        $resFindByTypeSdatchikomTorg = $this->getDoctrine()->getEntityManager()->getRepository(''
                        . 'ProjectBundle:torgFixture')
                ->findBy(array('appointmentTwo' => $sdatchikom));
        $resFindByTypeSdatchikomStreet = $this->getDoctrine()->getEntityManager()->getRepository(''
                        . 'ProjectBundle:streetFixture')
                ->findBy(array('appointmentTwo' => $sdatchikom));
        $resFindByTypeSdatchikomFito = $this->getDoctrine()->getEntityManager()->getRepository(''
                        . 'ProjectBundle:fitoFixture')
                ->findBy(array('appointmentTwo' => $sdatchikom));
        $resFindByTypeSdatchikomAzs = $this->getDoctrine()->getEntityManager()->getRepository(''
                        . 'ProjectBundle:azsFixture')
                ->findBy(array('appointmentTwo' => $sdatchikom));

        /** ----------------------------------------------------------------------------------- * */
        $resProm = $this->getDoctrine()->getEntityManager()->getRepository(''
                        . 'ProjectBundle:promFixture')
                ->findBy(array('type' => $promFixture));
        $resTorg = $this->getDoctrine()->getEntityManager()->getRepository(''
                        . 'ProjectBundle:torgFixture')
                ->findBy(array('type' => $torgFixture));
        $resOffice = $this->getDoctrine()->getEntityManager()->getRepository(''
                        . 'ProjectBundle:officeFixture')
                ->findBy(array('type' => $officeFixture));
        $resStreet = $this->getDoctrine()->getEntityManager()->getRepository(''
                        . 'ProjectBundle:streetFixture')
                ->findBy(array('type' => $streetFixture));
        $resFito = $this->getDoctrine()->getEntityManager()->getRepository(''
                        . 'ProjectBundle:fitoFixture')
                ->findBy(array('type' => $fitoFixture));
        $resAzs = $this->getDoctrine()->getEntityManager()->getRepository(''
                        . 'ProjectBundle:azsFixture')
                ->findBy(array('type' => $azsFixture));
        if ((count($resTorg) < 1) && (count($resProm) < 1) && (count(
                        $resOffice) < 1) && (count($resStreet) < 1) && (count(
                        $resFito) < 1) && (count($resAzs) < 1) && (count($resFindByTypePodvesnieProm) < 1) && (count($resFindByTypePodvesnieOffice) < 1) && (count($resFindByTypePodvesnieTorg) < 1) && (count($resFindByTypePodvesnieStreet) < 1) && (count($resFindByTypePodvesnieFito) < 1) && (count($resFindByTypePodvesnieAzs) < 1) && (count($resFindByTypeVstraivaemieProm) < 1) && (count($resFindByTypeVstraivaemieOffice) < 1) && (count($resFindByTypeVstraivaemieTorg) < 1) && (count($resFindByTypeVstraivaemieStreet) < 1) && (count($resFindByTypeVstraivaemieFito) < 1) && (count($resFindByTypeVstraivaemieAzs) < 1) && (count($resFindByTypeNakladnieProm) < 1) && (count($resFindByTypeNakladnieOffice) < 1) && (count($resFindByTypeNakladnieTorg) < 1) && (count($resFindByTypeNakladnieStreet) < 1) && (count($resFindByTypeNakladnieFito) < 1) && (count($resFindByTypeNakladnieAzs) < 1) && (count($resFindByTypeUlichnieProm) < 1) && (count($resFindByTypeUlichnieOffice) < 1) && (count($resFindByTypeUlichnieTorg) < 1) && (count($resFindByTypeUlichnieStreet) < 1) && (count($resFindByTypeUlichnieFito) < 1) && (count($resFindByTypeUlichnieAzs) < 1) && (count($resFindByTypePotolochnieProm) < 1) && (count($resFindByTypePotolochnieOffice) < 1) && (count($resFindByTypePotolochnieTorg) < 1) && (count($resFindByTypePotolochnieStreet) < 1) && (count($resFindByTypePotolochnieFito) < 1) && (count($resFindByTypePotolochnieAzs) < 1) && (count($resFindByTypeNastennieProm) < 1) && (count($resFindByTypeNastennieOffice) < 1) && (count($resFindByTypeNastennieTorg) < 1) && (count($resFindByTypeNastennieStreet) < 1) && (count($resFindByTypeNastennieFito) < 1) && (count($resFindByTypeNastennieAzs) < 1) && (count($resFindByTypeSdatchikomProm) < 1) && (count($resFindByTypeSdatchikomOffice) < 1) && (count($resFindByTypeSdatchikomTorg) < 1) && (count($resFindByTypeSdatchikomStreet) < 1) && (count($resFindByTypeSdatchikomFito) < 1) && (count($resFindByTypeSdatchikomAzs) < 1) ) {
            $count = count($promfixtures) + count($officefixtures) + count($torgfixtures) + count($streetfixtures) + count($fitofixtures) + count($azsfixtures);
            return $this->render('ProjectBundle:Default:fixtures.html.twig', array(''
                        . 'promfixtures' => $promfixtures, ''
                        . 'officefixtures' => $officefixtures, ''
                        . 'torgfixtures' => $torgfixtures, ''
                        . 'streetfixtures' => $streetfixtures, ''
                        . 'fitofixtures' => $fitofixtures, ''
                        . 'azsfixtures' => $azsfixtures, ''
                        . 'count' => $count, ''
                        . 'inputFielsd' => $inputFields));
        }
        $cnt = count($resTorg) + count($resProm) + count($resOffice) + count($resStreet) + count($resAzs) + count($resFito) + count($resFindByTypePodvesnieProm) +
                    count($resFindByTypePodvesnieOffice) + count($resFindByTypePodvesnieTorg) +
                    count($resFindByTypePodvesnieStreet) + count($resFindByTypePodvesnieFito) + count($resFindByTypePodvesnieAzs) + count($resFindByTypeNakladnieProm) +
                    count($resFindByTypeNakladnieOffice) + count($resFindByTypeNakladnieTorg) +
                    count($resFindByTypeNakladnieStreet) + count($resFindByTypeNakladnieFito) + count($resFindByTypeNakladnieAzs) + count($resFindByTypeUlichnieProm) +
                    count($resFindByTypeUlichnieOffice) + count($resFindByTypeUlichnieTorg) +
                    count($resFindByTypeUlichnieStreet) + count($resFindByTypeUlichnieFito) + count($resFindByTypeUlichnieAzs) + count($resFindByTypeVstraivaemieProm) +
                    count($resFindByTypeVstraivaemieOffice) + count($resFindByTypeVstraivaemieTorg) +
                    count($resFindByTypeVstraivaemieStreet) + count($resFindByTypeVstraivaemieFito) + count($resFindByTypeVstraivaemieAzs) + count($resFindByTypePotolochnieProm) +
                    count($resFindByTypePotolochnieOffice) + count($resFindByTypePotolochnieTorg) +
                    count($resFindByTypePotolochnieStreet) + count($resFindByTypePotolochnieFito) + count($resFindByTypePotolochnieAzs) + count($resFindByTypeNastennieProm) +
                    count($resFindByTypeNastennieOffice) + count($resFindByTypeNastennieTorg) +
                    count($resFindByTypeNastennieStreet) + count($resFindByTypeNastennieFito) + count($resFindByTypeNastennieAzs) + count($resFindByTypeSdatchikomProm) +
                    count($resFindByTypeSdatchikomOffice) + count($resFindByTypeSdatchikomTorg) +
                    count($resFindByTypeSdatchikomStreet) + count($resFindByTypeSdatchikomFito) + count($resFindByTypeSdatchikomAzs);
        return $this->render('ProjectBundle:Default:fixtures.html.twig', array(''
                    . 'resTorg' => $resTorg, ''
                    . 'resProm' => $resProm, ''
                    . 'resOffice' => $resOffice, ''
                    . 'resStreet' => $resStreet, ''
                    . 'resFito' => $resFito, ''
                    . 'resAzs' => $resAzs, ''
                    . 'resFindByTypePodvesnieProm' => $resFindByTypePodvesnieProm, ''
                    . 'resFindByTypePodvesnieOffice' => $resFindByTypePodvesnieOffice, ''
                    . 'resFindByTypePodvesnieTorg' => $resFindByTypePodvesnieTorg, ''
                    . 'resFindByTypePodvesnieStreet' => $resFindByTypePodvesnieStreet, ''
                    . 'resFindByTypePodvesnieFito' => $resFindByTypePodvesnieFito, ''
                    . 'resFindByTypePodvesnieAzs' => $resFindByTypePodvesnieAzs, ''
                    . 'resFindByTypeNakladnieProm' => $resFindByTypeNakladnieProm, ''
                    . 'resFindByTypeNakladnieOffice' => $resFindByTypeNakladnieOffice, ''
                    . 'resFindByTypeNakladnieTorg' => $resFindByTypeNakladnieTorg, ''
                    . 'resFindByTypeNakladnieStreet' => $resFindByTypeNakladnieStreet, ''
                    . 'resFindByTypeNakladnieFito' => $resFindByTypeNakladnieFito, ''
                    . 'resFindByTypeNakladnieAzs' => $resFindByTypeNakladnieAzs, ''
                    . 'resFindByTypeVstraivaemieProm' => $resFindByTypeVstraivaemieProm, ''
                    . 'resFindByTypeVstraivaemieOffice' => $resFindByTypeVstraivaemieOffice, ''
                    . 'resFindByTypeVstraivaemieTorg' => $resFindByTypeVstraivaemieTorg, ''
                    . 'resFindByTypeVstraivaemieStreet' => $resFindByTypeVstraivaemieStreet, ''
                    . 'resFindByTypeVstraivaemieFito' => $resFindByTypeVstraivaemieFito, ''
                    . 'resFindByTypeVstraivaemieAzs' => $resFindByTypeVstraivaemieAzs, ''
                    . 'resFindByTypeUlichnieProm' => $resFindByTypeUlichnieProm, ''
                    . 'resFindByTypeUlichnieOffice' => $resFindByTypeUlichnieOffice, ''
                    . 'resFindByTypeUlichnieTorg' => $resFindByTypeUlichnieTorg, ''
                    . 'resFindByTypeUlichnieStreet' => $resFindByTypeUlichnieStreet, ''
                    . 'resFindByTypeUlichnieFito' => $resFindByTypeUlichnieFito, ''
                    . 'resFindByTypeUlichnieAzs' => $resFindByTypeUlichnieAzs, ''
                    . 'resFindByTypePotolochnieProm' => $resFindByTypePotolochnieProm, ''
                    . 'resFindByTypePotolochnieOffice' => $resFindByTypePotolochnieOffice, ''
                    . 'resFindByTypePotolochnieTorg' => $resFindByTypePotolochnieTorg, ''
                    . 'resFindByTypePotolochnieStreet' => $resFindByTypePotolochnieStreet, ''
                    . 'resFindByTypePotolochnieFito' => $resFindByTypePotolochnieFito, ''
                    . 'resFindByTypePotolochnieAzs' => $resFindByTypePotolochnieAzs, ''
                    . 'resFindByTypeNastennieProm' => $resFindByTypeNastennieProm, ''
                    . 'resFindByTypeNastennieOffice' => $resFindByTypeNastennieOffice, ''
                    . 'resFindByTypeNastennieTorg' => $resFindByTypeNastennieTorg, ''
                    . 'resFindByTypeNastennieStreet' => $resFindByTypeNastennieStreet, ''
                    . 'resFindByTypeNastennieFito' => $resFindByTypeNastennieFito, ''
                    . 'resFindByTypeNastennieAzs' => $resFindByTypeNastennieAzs, ''
                    . 'resFindByTypeSdatchikomProm' => $resFindByTypeSdatchikomProm, ''
                    . 'resFindByTypeSdatchikomOffice' => $resFindByTypeSdatchikomOffice, ''
                    . 'resFindByTypeSdatchikomTorg' => $resFindByTypeSdatchikomTorg, ''
                    . 'resFindByTypeSdatchikomStreet' => $resFindByTypeSdatchikomStreet, ''
                    . 'resFindByTypeSdatchikomFito' => $resFindByTypeSdatchikomFito, ''
                    . 'resFindByTypeSdatchikomAzs' => $resFindByTypeSdatchikomAzs, ''
                    . 'count' => $cnt, ''
                    . 'inputFielsd' => $inputFields));

        $count = count($promfixtures) + count($officefixtures) + count($torgfixtures) + count($streetfixtures) + count($fitofixtures) + count($azsfixtures);
        return $this->render('ProjectBundle:Default:fixtures.html.twig', array(''
                    . 'promfixtures' => $promfixtures, ''
                    . 'officefixtures' => $officefixtures, ''
                    . 'torgfixtures' => $torgfixtures, ''
                    . 'streetfixtures' => $streetfixtures, ''
                    . 'fitofixtures' => $fitofixtures, ''
                    . 'azsfixtures' => $azsfixtures, ''
                    . 'count' => $count, ''
                    . 'inputFielsd' => $inputFields));
    }

    /**
     * @Route("/fixtures/prom/{id}", name="fullPromFixture")
     */
    public function listFullPromFixture($id) {

        $fixture = $this->getDoctrine()->getRepository('ProjectBundle:promFixture')
                ->findOneBy(array('id' => $id));
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery(
                        'SELECT p
    FROM ProjectBundle:promFixture p 
    WHERE p.id != :id'
                )->setParameter('id', $id);

        $similarFixtures = $query->setMaxResults(5)->getResult();

        if (!$fixture) {
            return $this->redirectToRoute('home');
        }
        return $this->render('ProjectBundle:Default:fullPromFixture.html.twig', array(''
                    . 'fixture' => $fixture, ''
                    . 'similarFixtures' => $similarFixtures));
    }

    /**
     * @Route("/fixtures/office/{id}", name="fullOfficeFixture")
     */
    public function listFullOfficeFixture($id) {

        $fixture = $this->getDoctrine()->getRepository('ProjectBundle:officeFixture')
                ->findOneBy(array('id' => $id));
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery(
                        'SELECT p
    FROM ProjectBundle:officeFixture p
    WHERE p.id != :id'
                )->setParameter('id', $id);

        $similarFixtures = $query->setMaxResults(5)->getResult();

        if (!$fixture) {
            return $this->redirectToRoute('home');
        }
        return $this->render('ProjectBundle:Default:fullOfficeFixture.html.twig', array(''
                    . 'fixture' => $fixture, ''
                    . 'similarFixtures' => $similarFixtures));
    }

    /**
     * @Route("/fixtures/torg/{id}", name="fullTorgFixture")
     */
    public function listFullTorgFixture($id) {

        $fixture = $this->getDoctrine()->getRepository('ProjectBundle:torgFixture')
                ->findOneBy(array('id' => $id));
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery(
                        'SELECT p
    FROM ProjectBundle:torgFixture p
    WHERE p.id != :id'
                )->setParameter('id', $id);

        $similarFixtures = $query->setMaxResults(5)->getResult();

        if (!$fixture) {
            return $this->redirectToRoute('home');
        }
        return $this->render('ProjectBundle:Default:fullTorgFixture.html.twig', array(''
                    . 'fixture' => $fixture, ''
                    . 'similarFixtures' => $similarFixtures));
    }

    /**
     * @Route("/fixtures/street/{id}", name="fullStreetFixture")
     */
    public function listFullStreetFixture($id) {

        $fixture = $this->getDoctrine()->getRepository('ProjectBundle:streetFixture')
                ->findOneBy(array('id' => $id));
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery(
                        'SELECT p
    FROM ProjectBundle:streetFixture p
    WHERE p.id != :id'
                )->setParameter('id', $id);

        $similarFixtures = $query->setMaxResults(5)->getResult();

        if (!$fixture) {
            return $this->redirectToRoute('home');
        }
        return $this->render('ProjectBundle:Default:fullStreetFixture.html.twig', array(''
                    . 'fixture' => $fixture, ''
                    . 'similarFixtures' => $similarFixtures));
    }

    /**
     * @Route("/fixtures/fito/{id}", name="fullFitoFixture")
     */
    public function listFullFitoFixture($id) {

        $fixture = $this->getDoctrine()->getRepository('ProjectBundle:fitoFixture')
                ->findOneBy(array('id' => $id));
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery(
                        'SELECT p
    FROM ProjectBundle:fitoFixture p
    WHERE p.id != :id'
                )->setParameter('id', $id);

        $similarFixtures = $query->setMaxResults(5)->getResult();


        if (!$fixture) {
            return $this->redirectToRoute('home');
        }
        return $this->render('ProjectBundle:Default:fullFitoFixture.html.twig', array(''
                    . 'fixture' => $fixture, ''
                    . 'similarFixtures' => $similarFixtures));
    }

    /**
     * @Route("/fixtures/azs/{id}", name="fullAzsFixture")
     */
    public function listFullAzsFixture($id) {

        $fixture = $this->getDoctrine()->getRepository('ProjectBundle:azsFixture')
                ->findOneBy(array('id' => $id));
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery(
                        'SELECT p
    FROM ProjectBundle:azsFixture p
    WHERE p.id != :id'
                )->setParameter('id', $id);

        $similarFixtures = $query->setMaxResults(5)->getResult();

        if (!$fixture) {
            return $this->redirectToRoute('home');
        }
        return $this->render('ProjectBundle:Default:fullAzsFixture.html.twig', array(''
                    . 'fixture' => $fixture, ''
                    . 'similarFixtures' => $similarFixtures));
    }

    /**
     * @Route("/lamp", name="lamp")
     */
    public function listLampAction() {
        return $this->render('ProjectBundle:Default:lamp.html.twig');
    }

}

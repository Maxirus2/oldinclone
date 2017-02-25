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
     * @Route("/lamp", name="lamp")
     */
    public function listLampAction() {
		$ASD = $this->getDoctrine()->getRepository('ProjectBundle:ASD')
                ->findAll();
		$count=count($ASD);
		return $this->render('ProjectBundle:Default:lamp.html.twig', array(''
						. 'result' => $ASD, ''
                        . 'count' => $count));
    }
	
    /**
     * @Route("/fixtures", name="findaction")
     */
    public function listFixturesAction(Request $request) {

        $promFixture = $request->get('prom');
		$projectFixture = $request->get('project');
        $officeFixture = $request->get('office');
        $torgFixture = $request->get('torg');
        $streetFixture = $request->get('street');
        $fitoFixture = $request->get('fito');
        $azsFixture = $request->get('azs');		
		$vip = $request->get('vip');	
		if($request->get('power')==144){
        $power144 = $request->get('power');		
		}		else $power144 = "";		
		if($request->get('power')==4589){
        $power4589 = $request->get('power');	
		}		
		else $power4589 = "";		
		if($request->get('power')==90199){
        $power90199 = $request->get('power');	
		}		else $power90199 = "";		
		if($request->get('power')==2001000){
        $power2001000 = $request->get('power');		
		}		else $power2001000 = "";						
		if($request->get('ip')==50){
        $stepdo5ip = $request->get('ip');		
		}		else{		$stepdo5ip = "";		
		}		if($request->get('ip')==5167){
        $stepdo5167ip = $request->get('ip');		
		}		else{		$stepdo5167ip = "";		
		}		if($request->get('ip')==6888){
        $stepdo6888ip = $request->get('ip');		
		}		else{		$stepdo6888ip = "";			
		}
		if($request->get('naznachenie')=="Встраиваемые"){
        $vstraivaemie = $request->get('naznachenie');
		}
		else {$vstraivaemie="";}
		if($request->get('naznachenie')=="Накладные"){
        $nakladnie = $request->get('naznachenie');
		}
		else {$nakladnie="";}
		if($request->get('naznachenie')=="Уличные(консольные)"){
        $ulichnie = $request->get('naznachenie');
		}
		else {$ulichnie="";}
		if($request->get('naznachenie')=="Подвесные"){
        $podvesnie = $request->get('naznachenie');
		}
		else {$podvesnie="";}
		if($request->get('naznachenie')=="Потолочные"){
        $potolochnie = $request->get('naznachenie');
		}
		else {$potolochnie="";}
		if($request->get('naznachenie')=="Настенные"){
        $nastennie = $request->get('naznachenie');
		}
		else {$nastennie="";}
		if($request->get('naznachenie')=="С датчиком движения"){
        $sdatchikom = $request->get('naznachenie');
		}
		else {$sdatchikom="";}
		
        $inputFields = array($promFixture, $officeFixture, $torgFixture, $streetFixture, $fitoFixture, $azsFixture,
            $power144, $power4589, $power90199, $power2001000, $stepdo5ip, $stepdo5167ip, $stepdo6888ip, $vstraivaemie,
            $nakladnie, $ulichnie, $podvesnie, $potolochnie, $nastennie, $sdatchikom,$projectFixture,$vip);
			
			
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
		$projectfixtures = $this->getDoctrine()->getRepository('ProjectBundle:projectFixture')
                ->findAll();
	    $vipfixtures = $this->getDoctrine()->getRepository('ProjectBundle:vip')
                ->findAll();  
				
		
		
		
					
					
					
        $em = $this->getDoctrine()->getManager();
		/*         * *      Первый блок         ** */
		$count=0;
		
		    $Vipfixtures=array();
		    $Promfixtures=array();
			$Azsfixtures=array();
			$Officefixtures=array();
			$Torgfixtures=array();
			$Streetfixtures=array();
			$Fitofixtures=array();
			$Projectfixtures=array();
		
        if(isset($_POST['project'])){
	        $Projectfixtures=$projectfixtures;
			$count=$count+count($Projectfixtures);
		}   		
		if(isset($_POST['vip'])){
	        $Vipfixtures=$vipfixtures;
			$count=$count+count($Vipfixtures);
		}   
		if(isset($_POST['prom'])){
	        $Promfixtures=$promfixtures;
			$count=$count+count($Promfixtures);
		}   
		if(isset($_POST['office'])){
			 $Officefixtures=$officefixtures;
	        $count=$count+count($Officefixtures);
		}   
		if(isset($_POST['torg'])){
	        $Torgfixtures=$torgfixtures;
			$count=$count+count($Torgfixtures);
		}   
		if(isset($_POST['street'])){
			$Streetfixtures=$streetfixtures;
	        $count=$count+count($Streetfixtures);
		}   
		if(isset($_POST['fito'])){
			$Fitofixtures=$fitofixtures;
	        $count=$count+count($Fitofixtures);
		}   
		if(isset($_POST['azs'])){
			$Azsfixtures=$azsfixtures;
	        $count=$count+count($Azsfixtures);
		}
		if(isset($_POST['azs'])||isset($_POST['fito'])||isset($_POST['street'])||isset($_POST['torg'])||isset($_POST['office'])||isset($_POST['prom'])||isset($_POST['project'])||isset($_POST['vip'])){
		$promfixtures=$Promfixtures;
		$azsfixtures=$Azsfixtures;
		$officefixtures=$Officefixtures;
		$torgfixtures=$Torgfixtures;
		$streetfixtures=$Streetfixtures;
		$fitofixtures=$Fitofixtures;
		$vipfixtures=$Vipfixtures;
		$projectfixtures=$Projectfixtures;
		}
		else{$count = count($promfixtures) + count($officefixtures) + count($torgfixtures) + count($streetfixtures) + count($fitofixtures) + count($azsfixtures)+ count($projectfixtures);}
		
		
		/*         * *        Первый блок         ** */
		/*         * *        Второй блок        ** */
		if($power144==144){
			    $count=0;
				$count1=count($promfixtures);	
				for($i=0;$i<$count1;$i++){	
				if($promfixtures!=0){
				if(empty($promfixtures[$i])){}	
				else{	
				$vfr[0]=$promfixtures[$i];		
				foreach($vfr as $post) {       
				$cheak=$post->getPower();	
				if($cheak>=1 and $cheak<=44){			
				}			
				else{		
				unset($promfixtures[$i]); 	
				}        
				}
				}
				}				
				}	
				if($promfixtures!=0){
				$count=$count+count($promfixtures); 
				}
				
				$count1=count($azsfixtures);	
				for($i=0;$i<$count1;$i++){	
				if($azsfixtures!=0){
				if(empty($azsfixtures[$i])){}	
				else{
				$vfr[0]=$azsfixtures[$i];		
				foreach($vfr as $post) {       
				$cheak=$post->getPower();	
				if($cheak>=1 and $cheak<=44){			
				}			
				else{		
				unset($azsfixtures[$i]); 	
				}        
				}		  	
				}
				}				
				}
				if($azsfixtures!=0){
				$count=$count+count($azsfixtures); 
				}
				
				$count1=count($projectfixtures);	
				for($i=0;$i<$count1;$i++){	
				if($projectfixtures!=0){
				if(empty($projectfixtures[$i])){}	
				else{
				$vfr[0]=$projectfixtures[$i];		
				foreach($vfr as $post) {       
				$cheak=$post->getPower();	
				if($cheak>=1 and $cheak<=44){			
				}			
				else{		
				unset($projectfixtures[$i]); 	
				}        
				}		  	
				}
				}				
				}
				if($projectfixtures!=0){
				$count=$count+count($projectfixtures); 
				}
				
				$count1=count($officefixtures);	
				for($i=0;$i<$count1;$i++){	
				if($officefixtures!=0){
				if(empty($officefixtures[$i])){}	
				else{
				$vfr[0]=$officefixtures[$i];		
				foreach($vfr as $post) {       
				$cheak=$post->getPower();	
				if($cheak>=1 and $cheak<=44){			
				}			
				else{		
				unset($officefixtures[$i]); 	
				}        
				}	
				}				
				}
				}				
				if($officefixtures!=0){
				$count=$count+count($officefixtures);
				}	

                $count1=count($torgfixtures);	
				for($i=0;$i<$count1;$i++){	
				if($torgfixtures!=0){
				if(empty($torgfixtures[$i])){}	
				else{
				$vfr[0]=$torgfixtures[$i];		
				foreach($vfr as $post) {       
				$cheak=$post->getPower();	
				if($cheak>=1 and $cheak<=44){			
				}			
				else{		
				unset($torgfixtures[$i]); 	
				}        
				}
				}				
				}				
				}	
				if($torgfixtures!=0){
				$count=$count+count($torgfixtures);
				}		

                $count1=count($streetfixtures);	
				for($i=0;$i<$count1;$i++){	
				if($streetfixtures!=0){
				if(empty($streetfixtures[$i])){}	
				else{
				$vfr[0]=$streetfixtures[$i];		
				foreach($vfr as $post) {       
				$cheak=$post->getPower();	
				if($cheak>=1 and $cheak<=44){			
				}			
				else{		
				unset($streetfixtures[$i]); 	
				}        
				}	
				}	
				}				
				}	
				if($streetfixtures!=0){
				$count=$count+count($streetfixtures);
				}			

				$count1=count($fitofixtures);	
				for($i=0;$i<$count1;$i++){	
				if($fitofixtures!=0){
				if(empty($fitofixtures[$i])){}	
				else{
				$vfr[0]=$fitofixtures[$i];		
				foreach($vfr as $post) {       
				$cheak=$post->getPower();	
				if($cheak>=1 and $cheak<=44){			
				}			
				else{		
				unset($fitofixtures[$i]); 	
				}        
				}	
				}
				}				
				}	
				if($fitofixtures!=0){
				$count=$count+count($fitofixtures);
				}		
		}
		if($power4589==4589){
			$count=0;
				$count1=count($promfixtures);	
				for($i=0;$i<$count1;$i++){	
				if($promfixtures!=0){
				if(empty($promfixtures[$i])){}	
				else{
				$vfr[0]=$promfixtures[$i];		
				foreach($vfr as $post) {       
				$cheak=$post->getPower();	
				if($cheak>=45 and $cheak<=89){			
				}			
				else{		
				unset($promfixtures[$i]); 	
				}        
				}
				}				
				}				
				}	
				if($promfixtures!=0){
				$count=$count+count($promfixtures); 
				}
				
				$count1=count($azsfixtures);	
				for($i=0;$i<$count1;$i++){	
				if($azsfixtures!=0){
				if(empty($azsfixtures[$i])){}	
				else{			
				$vfr[0]=$azsfixtures[$i];		
				foreach($vfr as $post) {       
				$cheak=$post->getPower();	
				if($cheak>=45 and $cheak<=89){			
				}			
				else{		
				unset($azsfixtures[$i]); 	
				}  
				}				
				}		  	
				}	
				}
				if($azsfixtures!=0){
				$count=$count+count($azsfixtures); 
				}
				
				$count1=count($projectfixtures);	
				for($i=0;$i<$count1;$i++){	
				if($projectfixtures!=0){
				if(empty($projectfixtures[$i])){}	
				else{			
				$vfr[0]=$projectfixtures[$i];		
				foreach($vfr as $post) {       
				$cheak=$post->getPower();	
				if($cheak>=45 and $cheak<=89){			
				}			
				else{		
				unset($projectfixtures[$i]); 	
				}  
				}				
				}		  	
				}	
				}
				if($projectfixtures!=0){
				$count=$count+count($projectfixtures); 
				}
				
				$count1=count($officefixtures);	
				for($i=0;$i<$count1;$i++){	
				if($officefixtures!=0){
				if(empty($officefixtures[$i])){}	
				else{
				$vfr[0]=$officefixtures[$i];		
				foreach($vfr as $post) {       
				$cheak=$post->getPower();	
				if($cheak>=45 and $cheak<=89){			
				}			
				else{		
				unset($officefixtures[$i]); 	
				}        
				}	
				}
				}				
				}	
				if($officefixtures!=0){
				$count=$count+count($officefixtures);
				}	

                $count1=count($torgfixtures);	
				for($i=0;$i<$count1;$i++){	
				if($torgfixtures!=0){
				if(empty($torgfixtures[$i])){}	
				else{	
				$vfr[0]=$torgfixtures[$i];		
				foreach($vfr as $post) {       
				$cheak=$post->getPower();	
				if($cheak>=45 and $cheak<=89){			
				}			
				else{		
				unset($torgfixtures[$i]); 	
				}        
				}	
				}
				}				
				}	
				if($torgfixtures!=0){
				$count=$count+count($torgfixtures);
				}		

                $count1=count($streetfixtures);	
				for($i=0;$i<$count1;$i++){	
				if($streetfixtures!=0){
				if(empty($streetfixtures[$i])){}	
				else{	
				$vfr[0]=$streetfixtures[$i];		
				foreach($vfr as $post) {       
				$cheak=$post->getPower();	
				if($cheak>=45 and $cheak<=89){			
				}			
				else{		
				unset($streetfixtures[$i]); 	
				}        
				}	
				}	
				}
				}	
				if($streetfixtures!=0){
				$count=$count+count($streetfixtures);
				}			

				$count1=count($fitofixtures);	
				for($i=0;$i<$count1;$i++){	
				if($fitofixtures!=0){
				if(empty($fitofixtures[$i])){}	
				else{	
				$vfr[0]=$fitofixtures[$i];		
				foreach($vfr as $post) {       
				$cheak=$post->getPower();	
				if($cheak>=45 and $cheak<=89){			
				}			
				else{		
				unset($fitofixtures[$i]); 	
				}  
                }
				}	
				}				
				}	
				if($fitofixtures!=0){
				$count=$count+count($fitofixtures);
				}		
		}
		
		if($power90199==90199){
			$count=0;
				$count1=count($promfixtures);	
				for($i=0;$i<$count1;$i++){	
				if($promfixtures!=0){
				if(empty($promfixtures[$i])){}	
				else{
				$vfr[0]=$promfixtures[$i];		
				foreach($vfr as $post) {       
				$cheak=$post->getPower();	
				if($cheak>=90 and $cheak<=199){			
				}			
				else{		
				unset($promfixtures[$i]); 	
				}        
				}	
				}
				}				
				}	
				if($promfixtures!=0){
				$count=$count+count($promfixtures); 
				}
				
				$count1=count($azsfixtures);	
				for($i=0;$i<$count1;$i++){	
				if($azsfixtures!=0){
				if(empty($azsfixtures[$i])){}	
				else{
				$vfr[0]=$azsfixtures[$i];		
				foreach($vfr as $post) {       
				$cheak=$post->getPower();	
				if($cheak>=90 and $cheak<=199){			
				}			
				else{		
				unset($azsfixtures[$i]); 	
				}        
				}	
				}				
				}	
				}
				if($azsfixtures!=0){
				$count=$count+count($azsfixtures); 
				}
				
				$count1=count($projectfixtures);	
				for($i=0;$i<$count1;$i++){	
				if($projectfixtures!=0){
				if(empty($projectfixtures[$i])){}	
				else{
				$vfr[0]=$projectfixtures[$i];		
				foreach($vfr as $post) {       
				$cheak=$post->getPower();	
				if($cheak>=90 and $cheak<=199){			
				}			
				else{		
				unset($projectfixtures[$i]); 	
				}        
				}	
				}				
				}	
				}
				if($projectfixtures!=0){
				$count=$count+count($projectfixtures); 
				}
				
				$count1=count($officefixtures);	
				for($i=0;$i<$count1;$i++){	
				if($officefixtures!=0){
				if(empty($officefixtures[$i])){}	
				else{			
				$vfr[0]=$officefixtures[$i];		
				foreach($vfr as $post) {       
				$cheak=$post->getPower();	
				if($cheak>=90 and $cheak<=199){				
				}			
				else{		
				unset($officefixtures[$i]); 	
				}        
				}	
				}			
				}				
				}	
				if($officefixtures!=0){
				$count=$count+count($officefixtures);
				}	

                $count1=count($torgfixtures);	
				for($i=0;$i<$count1;$i++){	
				if($torgfixtures!=0){
				if(empty($torgfixtures[$i])){}	
				else{
				$vfr[0]=$torgfixtures[$i];		
				foreach($vfr as $post) {       
				$cheak=$post->getPower();	
				if($cheak>=90 and $cheak<=199){		
				}			
				else{		
				unset($torgfixtures[$i]); 	
				}        
				}
				}				
				}				
				}	
				if($torgfixtures!=0){
				$count=$count+count($torgfixtures);
				}		

                $count1=count($streetfixtures);	
				for($i=0;$i<$count1;$i++){	
				if($streetfixtures!=0){
				if(empty($streetfixtures[$i])){}	
				else{
				$vfr[0]=$streetfixtures[$i];		
				foreach($vfr as $post) {       
				$cheak=$post->getPower();	
				if($cheak>=90 and $cheak<=199){		
				}			
				else{		
				unset($streetfixtures[$i]); 	
				}        
				}	
				}
				}				
				}	
				if($streetfixtures!=0){
				$count=$count+count($streetfixtures);
				}			

				$count1=count($fitofixtures);	
				for($i=0;$i<$count1;$i++){	
				if($fitofixtures!=0){
				if(empty($fitofixtures[$i])){}	
				else{
				$vfr[0]=$fitofixtures[$i];		
				foreach($vfr as $post) {       
				$cheak=$post->getPower();	
				if($cheak>=90 and $cheak<=199){		
				}			
				else{		
				unset($fitofixtures[$i]); 	
				}        
				}	
				}
				}				
				}	
				if($fitofixtures!=0){
				$count=$count+count($fitofixtures);
				}		
		}
		
		if($power2001000==2001000){
			$count=0;
				$count1=count($promfixtures);	
				for($i=0;$i<$count1;$i++){	
				if($promfixtures!=0){
				if(empty($promfixtures[$i])){}	
				else{	
				$vfr[0]=$promfixtures[$i];		
				foreach($vfr as $post) {       
				$cheak=$post->getPower();	
				if($cheak>=200 and $cheak<=1000){			
				}			
				else{		
				unset($promfixtures[$i]); 	
				}     
				}				
				}	
				}				
				}	
				if($promfixtures!=0){
				$count=$count+count($promfixtures); 
				}
				
				$count1=count($azsfixtures);	
				for($i=0;$i<$count1;$i++){	
				if($azsfixtures!=0){
				if(empty($azsfixtures[$i])){}	
				else{
				$vfr[0]=$azsfixtures[$i];		
				foreach($vfr as $post) {       
				$cheak=$post->getPower();	
				if($cheak>=200 and $cheak<=1000){			
				}			
				else{		
				unset($azsfixtures[$i]); 	
				}        
				}
				}		  	
				}	
				}
				if($azsfixtures!=0){
				$count=$count+count($azsfixtures); 
				}
				
				$count1=count($officefixtures);	
				for($i=0;$i<$count1;$i++){	
				if($officefixtures!=0){
				if(empty($officefixtures[$i])){}	
				else{	
				$vfr[0]=$officefixtures[$i];		
				foreach($vfr as $post) {       
				$cheak=$post->getPower();	
				if($cheak>=200 and $cheak<=1000){				
				}			
				else{		
				unset($officefixtures[$i]); 	
				}        
				}	
				}
				}				
				}	
				if($officefixtures!=0){
				$count=$count+count($officefixtures);
				}	

				$count1=count($projectfixtures);	
				for($i=0;$i<$count1;$i++){	
				if($projectfixtures!=0){
				if(empty($projectfixtures[$i])){}	
				else{	
				$vfr[0]=$projectfixtures[$i];		
				foreach($vfr as $post) {       
				$cheak=$post->getPower();	
				if($cheak>=200 and $cheak<=1000){			
				}			
				else{		
				unset($projectfixtures[$i]); 	
				}   
				}				
				}	
				}				
				}	
				if($projectfixtures!=0){
				$count=$count+count($projectfixtures);
				}	
				
				
                $count1=count($torgfixtures);	
				for($i=0;$i<$count1;$i++){	
				if($torgfixtures!=0){
				if(empty($torgfixtures[$i])){}	
				else{	
				$vfr[0]=$torgfixtures[$i];		
				foreach($vfr as $post) {       
				$cheak=$post->getPower();	
				if($cheak>=200 and $cheak<=1000){			
				}			
				else{		
				unset($torgfixtures[$i]); 	
				}   
				}				
				}	
				}				
				}	
				if($torgfixtures!=0){
				$count=$count+count($torgfixtures);
				}		

                $count1=count($streetfixtures);	
				for($i=0;$i<$count1;$i++){	
				if($streetfixtures!=0){
				if(empty($streetfixtures[$i])){}	
				else{	
				$vfr[0]=$streetfixtures[$i];		
				foreach($vfr as $post) {       
				$cheak=$post->getPower();	
				if($cheak>=200 and $cheak<=1000){		
				}			
				else{		
				unset($streetfixtures[$i]); 	
				}        
				}	
				}
				}				
				}	
				if($streetfixtures!=0){
				$count=$count+count($streetfixtures);
				}			

				$count1=count($fitofixtures);	
				for($i=0;$i<$count1;$i++){	
				if($fitofixtures!=0){
				if(empty($fitofixtures[$i])){}	
				else{
				$vfr[0]=$fitofixtures[$i];		
				foreach($vfr as $post) {       
				$cheak=$post->getPower();	
				if($cheak>=200 and $cheak<=1000){		
				}			
				else{		
				unset($fitofixtures[$i]); 	
				}        
				}	
				}
				}				
				}	
				if($fitofixtures!=0){
				$count=$count+count($fitofixtures);
				}		
		}
          /*         * *        Второй блок        ** */
	      /*         * *        Третий блок        ** */	
	 
	 if($stepdo5ip==50){
			$count=0;
					
				for($i=0;$i<30;$i++){	
				if($promfixtures!=0){
				if(empty($promfixtures[$i])){}	
				else{	
				$vfr[0]=$promfixtures[$i];		
				foreach($vfr as $post) {       
				$cheak=$post->getDegreeProtection();
				if($cheak<50){			
				}			
				else{		
				unset($promfixtures[$i]); 	
				}        
				}	
				}
				}				
				}	
				if($promfixtures!=0){
				$count=$count+count($promfixtures); 
				}
				
					
				for($i=0;$i<30;$i++){	
				if($azsfixtures!=0){
				if(empty($azsfixtures[$i])){}	
				else{
				$vfr[0]=$azsfixtures[$i];		
				foreach($vfr as $post) {       
				$cheak=$post->getDegreeProtection();
				if($cheak<50){					
				}			
				else{		
				unset($azsfixtures[$i]); 	
				}        
				}		  	
				}	
				}
				}
				if($azsfixtures!=0){
				$count=$count+count($azsfixtures); 
				}
				
				
				for($i=0;$i<30;$i++){	
				if($officefixtures!=0){
				if(empty($officefixtures[$i])){}	
				else{
				$vfr[0]=$officefixtures[$i];		
				foreach($vfr as $post) {       
				$cheak=$post->getDegreeProtection();
				if($cheak<50){						
				}			
				else{		
				unset($officefixtures[$i]); 	
				}        
				}	
				}
				}				
				}	
				if($officefixtures!=0){
				$count=$count+count($officefixtures);
				}	

                
				for($i=0;$i<30;$i++){	
				if($torgfixtures!=0){
				if(empty($torgfixtures[$i])){}	
				else{
				$vfr[0]=$torgfixtures[$i];		
				foreach($vfr as $post) {       
				$cheak=$post->getDegreeProtection();
				if($cheak<50){				
				}			
				else{		
				unset($torgfixtures[$i]); 	
				}        
				}	
				}
				}				
				}	
				if($torgfixtures!=0){
				$count=$count+count($torgfixtures);
				}		

				for($i=0;$i<30;$i++){	
				if($projectfixtures!=0){
				if(empty($projectfixtures[$i])){}	
				else{
				$vfr[0]=$projectfixtures[$i];		
				foreach($vfr as $post) {       
				$cheak=$post->getDegreeProtection();
				if($cheak<50){				
				}			
				else{		
				unset($projectfixtures[$i]); 	
				}        
				}	
				}
				}				
				}	
				if($projectfixtures!=0){
				$count=$count+count($projectfixtures);
				}		
               
				for($i=0;$i<30;$i++){	
				if($streetfixtures!=0){
				if(empty($streetfixtures[$i])){}	
				else{
				$vfr[0]=$streetfixtures[$i];		
				foreach($vfr as $post) {       
				$cheak=$post->getDegreeProtection();
				if($cheak<50){				
				}			
				else{		
				unset($streetfixtures[$i]); 	
				}        
				}	
				}
				}				
				}	
				if($streetfixtures!=0){
				$count=$count+count($streetfixtures);
				}			

					
				for($i=0;$i<30;$i++){	
				if($fitofixtures!=0){
				if(empty($fitofixtures[$i])){}	
				else{
				$vfr[0]=$fitofixtures[$i];		
				foreach($vfr as $post) {       
				$cheak=$post->getDegreeProtection();
				if($cheak<50){				
				}			
				else{		
				unset($fitofixtures[$i]); 	
				}      
				}				
				}	
				}				
				}	
				if($fitofixtures!=0){
				$count=$count+count($fitofixtures);
				}		
		}
		
		if($stepdo5167ip==5167){
			$count=0;
					
				for($i=0;$i<30;$i++){	
				if($promfixtures!=0){
				if(empty($promfixtures[$i])){}	
				else{	
				$vfr[0]=$promfixtures[$i];		
				foreach($vfr as $post) {       
				$cheak=$post->getDegreeProtection();
				if($cheak>=51 and $cheak<=67){			
				}			
				else{		
				unset($promfixtures[$i]); 	
				}        
				}	
				}
				}				
				}	
				if($promfixtures!=0){
				$count=$count+count($promfixtures); 
				}
				
				for($i=0;$i<30;$i++){	
				if($projectfixtures!=0){
				if(empty($projectfixtures[$i])){}	
				else{	
				$vfr[0]=$projectfixtures[$i];		
				foreach($vfr as $post) {       
				$cheak=$post->getDegreeProtection();
				if($cheak>=51 and $cheak<=67){			
				}			
				else{		
				unset($projectfixtures[$i]); 	
				}        
				}	
				}
				}				
				}	
				if($projectfixtures!=0){
				$count=$count+count($projectfixtures); 
				}
				
					
				for($i=0;$i<30;$i++){	
				if($azsfixtures!=0){
				if(empty($azsfixtures[$i])){}	
				else{
				$vfr[0]=$azsfixtures[$i];		
				foreach($vfr as $post) {       
				$cheak=$post->getDegreeProtection();
				if($cheak>=51 and $cheak<=67){				
				}			
				else{		
				unset($azsfixtures[$i]); 	
				}        
				}		  	
				}	
				}
				}
				if($azsfixtures!=0){
				$count=$count+count($azsfixtures); 
				}
				
				
				for($i=0;$i<30;$i++){	
				if($officefixtures!=0){
				if(empty($officefixtures[$i])){}	
				else{
				$vfr[0]=$officefixtures[$i];		
				foreach($vfr as $post) {       
				$cheak=$post->getDegreeProtection();
				if($cheak>=51 and $cheak<=67){					
				}			
				else{		
				unset($officefixtures[$i]); 	
				}        
				}	
				}
				}				
				}	
				if($officefixtures!=0){
				$count=$count+count($officefixtures);
				}	

                
				for($i=0;$i<30;$i++){	
				if($torgfixtures!=0){
				if(empty($torgfixtures[$i])){}	
				else{
				$vfr[0]=$torgfixtures[$i];		
				foreach($vfr as $post) {       
				$cheak=$post->getDegreeProtection();
				if($cheak>=51 and $cheak<=67){				
				}			
				else{		
				unset($torgfixtures[$i]); 	
				}        
				}	
				}
				}				
				}	
				if($torgfixtures!=0){
				$count=$count+count($torgfixtures);
				}		

               
				for($i=0;$i<30;$i++){	
				if($streetfixtures!=0){
				if(empty($streetfixtures[$i])){}	
				else{
				$vfr[0]=$streetfixtures[$i];		
				foreach($vfr as $post) {       
				$cheak=$post->getDegreeProtection();
				if($cheak>=51 and $cheak<=67){				
				}			
				else{		
				unset($streetfixtures[$i]); 	
				}        
				}	
				}
				}				
				}	
				if($streetfixtures!=0){
				$count=$count+count($streetfixtures);
				}			

					
				for($i=0;$i<30;$i++){	
				if($fitofixtures!=0){
				if(empty($fitofixtures[$i])){}	
				else{
				$vfr[0]=$fitofixtures[$i];		
				foreach($vfr as $post) {       
				$cheak=$post->getDegreeProtection();
				if($cheak>=51 and $cheak<=67){				
				}			
				else{		
				unset($fitofixtures[$i]); 	
				}      
				}				
				}	
				}				
				}	
				if($fitofixtures!=0){
				$count=$count+count($fitofixtures);
				}		
		}
	 
	     if($stepdo6888ip==6888){
			$count=0;
					
				for($i=0;$i<30;$i++){	
				if($promfixtures!=0){
				if(empty($promfixtures[$i])){}	
				else{	
				$vfr[0]=$promfixtures[$i];		
				foreach($vfr as $post) {       
				$cheak=$post->getDegreeProtection();
				if($cheak>=68 and $cheak<=88){			
				}			
				else{		
				unset($promfixtures[$i]);
                			
				}        
				}	
				}
				}				
				}	
				if($promfixtures!=0){
				$count=$count+count($promfixtures); 
				}
				
				for($i=0;$i<30;$i++){	
				if($projectfixtures!=0){
				if(empty($projectfixtures[$i])){}	
				else{	
				$vfr[0]=$projectfixtures[$i];		
				foreach($vfr as $post) {       
				$cheak=$post->getDegreeProtection();
				if($cheak>=68 and $cheak<=88){			
				}			
				else{		
				unset($projectfixtures[$i]);
                			
				}        
				}	
				}
				}				
				}	
				if($projectfixtures!=0){
				$count=$count+count($projectfixtures); 
				}

				
				for($i=0;$i<30;$i++){	
				if($azsfixtures!=0){
				if(empty($azsfixtures[$i])){}	
				else{
				$vfr[0]=$azsfixtures[$i];		
				foreach($vfr as $post) {       
				$cheak=$post->getDegreeProtection();
				if($cheak>=68 and $cheak<=88){					
				}			
				else{		
				unset($azsfixtures[$i]); 	
				}        
				}		  	
				}	
				}
				}
				if($azsfixtures!=0){
				$count=$count+count($azsfixtures); 
				}
				
				
				for($i=0;$i<30;$i++){	
				if($officefixtures!=0){
				if(empty($officefixtures[$i])){}	
				else{
				$vfr[0]=$officefixtures[$i];		
				foreach($vfr as $post) {       
				$cheak=$post->getDegreeProtection();
				if($cheak>=68 and $cheak<=88){					
				}			
				else{		
				unset($officefixtures[$i]); 	
				}        
				}	
				}
				}				
				}	
				if($officefixtures!=0){
				$count=$count+count($officefixtures);
				}	

                
				for($i=0;$i<30;$i++){	
				if($torgfixtures!=0){
				if(empty($torgfixtures[$i])){}	
				else{
				$vfr[0]=$torgfixtures[$i];		
				foreach($vfr as $post) {       
				$cheak=$post->getDegreeProtection();
				if($cheak>=68 and $cheak<=88){					
				}			
				else{		
				unset($torgfixtures[$i]); 	
				}        
				}	
				}
				}				
				}	
				if($torgfixtures!=0){
				$count=$count+count($torgfixtures);
				}		

               
				for($i=0;$i<30;$i++){	
				if($streetfixtures!=0){
				if(empty($streetfixtures[$i])){}	
				else{
				$vfr[0]=$streetfixtures[$i];		
				foreach($vfr as $post) {       
				$cheak=$post->getDegreeProtection();
				if($cheak>=68 and $cheak<=88){					
				}			
				else{		
				unset($streetfixtures[$i]); 	
				}        
				}	
				}
				}				
				}	
				if($streetfixtures!=0){
				$count=$count+count($streetfixtures);
				}			

					
				for($i=0;$i<30;$i++){	
				if($fitofixtures!=0){
				if(empty($fitofixtures[$i])){}	
				else{
				$vfr[0]=$fitofixtures[$i];		
				foreach($vfr as $post) {       
				$cheak=$post->getDegreeProtection();
				if($cheak>=68 and $cheak<=88){				
				}			
				else{		
				unset($fitofixtures[$i]); 	
				}      
				}				
				}	
				}				
				}	
				if($fitofixtures!=0){
				$count=$count+count($fitofixtures);
				}		
		}
	 	 /*         * *        Третий блок        ** */	
		 /*         * *        Четвертый блок        ** */	
	    if($vstraivaemie=="Встраиваемые"){
	            $count=0;	
				for($i=0;$i<30;$i++){	
				if($promfixtures!=0){
				if(empty($promfixtures[$i])){}	
				else{	
				$vfr[0]=$promfixtures[$i];		
				foreach($vfr as $post) {       
				$cheak=$post->getappointmentTwo();
				if($cheak!=$vstraivaemie){	
				unset($promfixtures[$i]); 
				}			
				else{		
				 	
				}        
				}	
				}
				}				
				}	
				if($promfixtures!=0){
				
				$count=$count+count($promfixtures); 
				}
	       	
			   for($i=0;$i<30;$i++){	
				if($projectfixtures!=0){
				if(empty($projectfixtures[$i])){}	
				else{	
				$vfr[0]=$projectfixtures[$i];		
				foreach($vfr as $post) {       
				$cheak=$post->getappointmentTwo();
				if($cheak!=$vstraivaemie){	
				unset($projectfixtures[$i]); 
				}			
				else{		
				 	
				}        
				}	
				}
				}				
				}	
				if($projectfixtures!=0){
				
				$count=$count+count($projectfixtures); 
				}
			
				for($i=0;$i<30;$i++){	
				if($fitofixtures!=0){
				if(empty($fitofixtures[$i])){}	
				else{	
				$vfr[0]=$fitofixtures[$i];		
				foreach($vfr as $post) {       
				$cheak=$post->getappointmentTwo();
				if($cheak!=$vstraivaemie){	
				unset($fitofixtures[$i]); 
				}			
				else{		
				 	
				}        
				}	
				}
				}				
				}	
				if($fitofixtures!=0){
				
				$count=$count+count($fitofixtures); 
				}     
		         
				 for($i=0;$i<30;$i++){	
				if($streetfixtures!=0){
				if(empty($streetfixtures[$i])){}	
				else{	
				$vfr[0]=$streetfixtures[$i];		
				foreach($vfr as $post) {       
				$cheak=$post->getappointmentTwo();
				if($cheak!=$vstraivaemie){	
				unset($streetfixtures[$i]); 
				}			
				else{		
				 	
				}        
				}	
				}
				}				
				}	
				if($streetfixtures!=0){
				
				$count=$count+count($streetfixtures); 
				}     
		         for($i=0;$i<30;$i++){	
				if($torgfixtures!=0){
				if(empty($torgfixtures[$i])){}	
				else{	
				$vfr[0]=$torgfixtures[$i];		
				foreach($vfr as $post) {       
				$cheak=$post->getappointmentTwo();
				if($cheak!=$vstraivaemie){	
				unset($torgfixtures[$i]); 
				}			
				else{		
				 	
				}        
				}	
				}
				}				
				}	
				if($torgfixtures!=0){
				
				$count=$count+count($torgfixtures); 
				}  
				
				for($i=0;$i<30;$i++){	
				if($azsfixtures!=0){
				if(empty($azsfixtures[$i])){}	
				else{	
				$vfr[0]=$azsfixtures[$i];		
				foreach($vfr as $post) {       
				$cheak=$post->getappointmentTwo();
				if($cheak!=$vstraivaemie){	
				unset($azsfixtures[$i]); 
				}			
				else{		
				 	
				}        
				}	
				}
				}				
				}	
				if($azsfixtures!=0){
				
				$count=$count+count($azsfixtures); 
				}  
					for($i=0;$i<30;$i++){	
				if($officefixtures!=0){
				if(empty($officefixtures[$i])){}	
				else{	
				$vfr[0]=$officefixtures[$i];		
				foreach($vfr as $post) {       
				$cheak=$post->getappointmentTwo();
				if($cheak!=$vstraivaemie){	
				unset($officefixtures[$i]); 
				}			
				else{		
				 	
				}        
				}	
				}
				}				
				}	
				if($officefixtures!=0){
				
				$count=$count+count($officefixtures); 
				}  
		}
	
	    	    if($nakladnie=="Накладные"){
	            $count=0;	
				for($i=0;$i<30;$i++){	
				if($promfixtures!=0){
				if(empty($promfixtures[$i])){}	
				else{	
				$vfr[0]=$promfixtures[$i];		
				foreach($vfr as $post) {       
				$cheak=$post->getappointmentTwo();
				if($cheak!=$nakladnie){	
				unset($promfixtures[$i]); 
				}			
				else{		
				 	
				}        
				}	
				}
				}				
				}	
				if($promfixtures!=0){
				
				$count=$count+count($promfixtures); 
				}
	       	
			for($i=0;$i<30;$i++){	
				if($projectfixtures!=0){
				if(empty($projectfixtures[$i])){}	
				else{	
				$vfr[0]=$projectfixtures[$i];		
				foreach($vfr as $post) {       
				$cheak=$post->getappointmentTwo();
				if($cheak!=$nakladnie){	
				unset($projectfixtures[$i]); 
				}			
				else{		
				 	
				}        
				}	
				}
				}				
				}	
				if($projectfixtures!=0){
				
				$count=$count+count($projectfixtures); 
				}
			
				for($i=0;$i<30;$i++){	
				if($fitofixtures!=0){
				if(empty($fitofixtures[$i])){}	
				else{	
				$vfr[0]=$fitofixtures[$i];		
				foreach($vfr as $post) {       
				$cheak=$post->getappointmentTwo();
			    if($cheak!=$nakladnie){		
				unset($fitofixtures[$i]); 
				}			
				else{		
				 	
				}        
				}	
				}
				}				
				}	
				if($fitofixtures!=0){
				
				$count=$count+count($fitofixtures); 
				}     
		         
				 for($i=0;$i<30;$i++){	
				if($streetfixtures!=0){
				if(empty($streetfixtures[$i])){}	
				else{	
				$vfr[0]=$streetfixtures[$i];		
				foreach($vfr as $post) {       
				$cheak=$post->getappointmentTwo();
				if($cheak!=$nakladnie){		
				unset($streetfixtures[$i]); 
				}			
				else{		
				 	
				}        
				}	
				}
				}				
				}	
				if($streetfixtures!=0){
				
				$count=$count+count($streetfixtures); 
				}     
		         for($i=0;$i<30;$i++){	
				if($torgfixtures!=0){
				if(empty($torgfixtures[$i])){}	
				else{	
				$vfr[0]=$torgfixtures[$i];		
				foreach($vfr as $post) {       
				$cheak=$post->getappointmentTwo();
				if($cheak!=$nakladnie){		
				unset($torgfixtures[$i]); 
				}			
				else{		
				 	
				}        
				}	
				}
				}				
				}	
				if($torgfixtures!=0){
				
				$count=$count+count($torgfixtures); 
				}  
				
				for($i=0;$i<30;$i++){	
				if($azsfixtures!=0){
				if(empty($azsfixtures[$i])){}	
				else{	
				$vfr[0]=$azsfixtures[$i];		
				foreach($vfr as $post) {       
				$cheak=$post->getappointmentTwo();
				if($cheak!=$nakladnie){		
				unset($azsfixtures[$i]); 
				}			
				else{		
				 	
				}        
				}	
				}
				}				
				}	
				if($azsfixtures!=0){
				
				$count=$count+count($azsfixtures); 
				}  
					for($i=0;$i<30;$i++){	
				if($officefixtures!=0){
				if(empty($officefixtures[$i])){}	
				else{	
				$vfr[0]=$officefixtures[$i];		
				foreach($vfr as $post) {       
				$cheak=$post->getappointmentTwo();
				if($cheak!=$nakladnie){		
				unset($officefixtures[$i]); 
				}			
				else{		
				 	
				}        
				}	
				}
				}				
				}	
				if($officefixtures!=0){
				
				$count=$count+count($officefixtures); 
				}  
		}
		
		   if($ulichnie=="Уличные(консольные)"){
	            $count=0;	
				for($i=0;$i<30;$i++){	
				if($promfixtures!=0){
				if(empty($promfixtures[$i])){}	
				else{	
				$vfr[0]=$promfixtures[$i];		
				foreach($vfr as $post) {       
				$cheak=$post->getappointmentTwo();
				if($cheak!=$ulichnie){	
				unset($promfixtures[$i]); 
				}			
				else{		
				 	
				}        
				}	
				}
				}				
				}	
				if($promfixtures!=0){
				
				$count=$count+count($promfixtures); 
				}
	       	
			for($i=0;$i<30;$i++){	
				if($projectfixtures!=0){
				if(empty($projectfixtures[$i])){}	
				else{	
				$vfr[0]=$projectfixtures[$i];		
				foreach($vfr as $post) {       
				$cheak=$post->getappointmentTwo();
				if($cheak!=$ulichnie){	
				unset($projectfixtures[$i]); 
				}			
				else{		
				 	
				}        
				}	
				}
				}				
				}	
				if($projectfixtures!=0){
				
				$count=$count+count($projectfixtures); 
				}
			
				for($i=0;$i<30;$i++){	
				if($fitofixtures!=0){
				if(empty($fitofixtures[$i])){}	
				else{	
				$vfr[0]=$fitofixtures[$i];		
				foreach($vfr as $post) {       
				$cheak=$post->getappointmentTwo();
			   	if($cheak!=$ulichnie){		
				unset($fitofixtures[$i]); 
				}			
				else{		
				 	
				}        
				}	
				}
				}				
				}	
				if($fitofixtures!=0){
				
				$count=$count+count($fitofixtures); 
				}     
		         
				 for($i=0;$i<30;$i++){	
				if($streetfixtures!=0){
				if(empty($streetfixtures[$i])){}	
				else{	
				$vfr[0]=$streetfixtures[$i];		
				foreach($vfr as $post) {       
				$cheak=$post->getappointmentTwo();
				if($cheak!=$ulichnie){	
				unset($streetfixtures[$i]); 
				}			
				else{		
				 	
				}        
				}	
				}
				}				
				}	
				if($streetfixtures!=0){
				
				$count=$count+count($streetfixtures); 
				}     
		         for($i=0;$i<30;$i++){	
				if($torgfixtures!=0){
				if(empty($torgfixtures[$i])){}	
				else{	
				$vfr[0]=$torgfixtures[$i];		
				foreach($vfr as $post) {       
				$cheak=$post->getappointmentTwo();
					if($cheak!=$ulichnie){	
				unset($torgfixtures[$i]); 
				}			
				else{		
				 	
				}        
				}	
				}
				}				
				}	
				if($torgfixtures!=0){
				
				$count=$count+count($torgfixtures); 
				}  
				
				for($i=0;$i<30;$i++){	
				if($azsfixtures!=0){
				if(empty($azsfixtures[$i])){}	
				else{	
				$vfr[0]=$azsfixtures[$i];		
				foreach($vfr as $post) {       
				$cheak=$post->getappointmentTwo();
				if($cheak!=$ulichnie){		
				unset($azsfixtures[$i]); 
				}			
				else{		
				 	
				}        
				}	
				}
				}				
				}	
				if($azsfixtures!=0){
				
				$count=$count+count($azsfixtures); 
				}  
					for($i=0;$i<30;$i++){	
				if($officefixtures!=0){
				if(empty($officefixtures[$i])){}	
				else{	
				$vfr[0]=$officefixtures[$i];		
				foreach($vfr as $post) {       
				$cheak=$post->getappointmentTwo();
					if($cheak!=$ulichnie){		
				unset($officefixtures[$i]); 
				}			
				else{		
				 	
				}        
				}	
				}
				}				
				}	
				if($officefixtures!=0){
				
				$count=$count+count($officefixtures); 
				}  
		}
           
		   if($podvesnie=="Подвесные"){
	            $count=0;	
				for($i=0;$i<30;$i++){	
				if($promfixtures!=0){
				if(empty($promfixtures[$i])){}	
				else{	
				$vfr[0]=$promfixtures[$i];		
				foreach($vfr as $post) {       
				$cheak=$post->getappointmentTwo();
			if($cheak!=$podvesnie){	
				unset($promfixtures[$i]); 
				}			
				else{		
				 	
				}        
				}	
				}
				}				
				}	
				if($promfixtures!=0){
				
				$count=$count+count($promfixtures); 
				}
	       	
			for($i=0;$i<30;$i++){	
				if($projectfixtures!=0){
				if(empty($projectfixtures[$i])){}	
				else{	
				$vfr[0]=$projectfixtures[$i];		
				foreach($vfr as $post) {       
				$cheak=$post->getappointmentTwo();
			if($cheak!=$podvesnie){	
				unset($projectfixtures[$i]); 
				}			
				else{		
				 	
				}        
				}	
				}
				}				
				}	
				if($promfixtures!=0){
				
				$count=$count+count($projectfixtures); 
				}
			
				for($i=0;$i<30;$i++){	
				if($fitofixtures!=0){
				if(empty($fitofixtures[$i])){}	
				else{	
				$vfr[0]=$fitofixtures[$i];		
				foreach($vfr as $post) {       
				$cheak=$post->getappointmentTwo();
			if($cheak!=$podvesnie){		
				unset($fitofixtures[$i]); 
				}			
				else{		
				 	
				}        
				}	
				}
				}				
				}	
				if($fitofixtures!=0){
				
				$count=$count+count($fitofixtures); 
				}     
		         
				 for($i=0;$i<30;$i++){	
				if($streetfixtures!=0){
				if(empty($streetfixtures[$i])){}	
				else{	
				$vfr[0]=$streetfixtures[$i];		
				foreach($vfr as $post) {       
				$cheak=$post->getappointmentTwo();
				if($cheak!=$podvesnie){	
				unset($streetfixtures[$i]); 
				}			
				else{		
				 	
				}        
				}	
				}
				}				
				}	
				if($streetfixtures!=0){
				
				$count=$count+count($streetfixtures); 
				}     
		         for($i=0;$i<30;$i++){	
				if($torgfixtures!=0){
				if(empty($torgfixtures[$i])){}	
				else{	
				$vfr[0]=$torgfixtures[$i];		
				foreach($vfr as $post) {       
				$cheak=$post->getappointmentTwo();
				if($cheak!=$podvesnie){		
				unset($torgfixtures[$i]); 
				}			
				else{		
				 	
				}        
				}	
				}
				}				
				}	
				if($torgfixtures!=0){
				
				$count=$count+count($torgfixtures); 
				}  
				
				for($i=0;$i<30;$i++){	
				if($azsfixtures!=0){
				if(empty($azsfixtures[$i])){}	
				else{	
				$vfr[0]=$azsfixtures[$i];		
				foreach($vfr as $post) {       
				$cheak=$post->getappointmentTwo();
				if($cheak!=$podvesnie){			
				unset($azsfixtures[$i]); 
				}			
				else{		
				 	
				}        
				}	
				}
				}				
				}	
				if($azsfixtures!=0){
				
				$count=$count+count($azsfixtures); 
				}  
					for($i=0;$i<30;$i++){	
				if($officefixtures!=0){
				if(empty($officefixtures[$i])){}	
				else{	
				$vfr[0]=$officefixtures[$i];		
				foreach($vfr as $post) {       
				$cheak=$post->getappointmentTwo();
					if($cheak!=$podvesnie){		
				unset($officefixtures[$i]); 
				}			
				else{		
				 	
				}        
				}	
				}
				}				
				}	
				if($officefixtures!=0){
				
				$count=$count+count($officefixtures); 
				}  
		}
		
		  if($potolochnie=="Потолочные"){
	            $count=0;	
				for($i=0;$i<30;$i++){	
				if($promfixtures!=0){
				if(empty($promfixtures[$i])){}	
				else{	
				$vfr[0]=$promfixtures[$i];		
				foreach($vfr as $post) {       
				$cheak=$post->getappointmentTwo();
			if($cheak!=$potolochnie){	
				unset($promfixtures[$i]); 
				}			
				else{		
				 	
				}        
				}	
				}
				}				
				}	
				if($promfixtures!=0){
				
				$count=$count+count($promfixtures); 
				}
	       	
			    for($i=0;$i<30;$i++){	
				if($projectfixtures!=0){
				if(empty($projectfixtures[$i])){}	
				else{	
				$vfr[0]=$projectfixtures[$i];		
				foreach($vfr as $post) {       
				$cheak=$post->getappointmentTwo();
			if($cheak!=$potolochnie){	
				unset($projectfixtures[$i]); 
				}			
				else{		
				 	
				}        
				}	
				}
				}				
				}	
				if($projectfixtures!=0){
				
				$count=$count+count($projectfixtures); 
				}
			
				for($i=0;$i<30;$i++){	
				if($fitofixtures!=0){
				if(empty($fitofixtures[$i])){}	
				else{	
				$vfr[0]=$fitofixtures[$i];		
				foreach($vfr as $post) {       
				$cheak=$post->getappointmentTwo();
			if($cheak!=$potolochnie){		
				unset($fitofixtures[$i]); 
				}			
				else{		
				 	
				}        
				}	
				}
				}				
				}	
				if($fitofixtures!=0){
				
				$count=$count+count($fitofixtures); 
				}     
		         
				 for($i=0;$i<30;$i++){	
				if($streetfixtures!=0){
				if(empty($streetfixtures[$i])){}	
				else{	
				$vfr[0]=$streetfixtures[$i];		
				foreach($vfr as $post) {       
				$cheak=$post->getappointmentTwo();
				if($cheak!=$potolochnie){	
				unset($streetfixtures[$i]); 
				}			
				else{		
				 	
				}        
				}	
				}
				}				
				}	
				if($streetfixtures!=0){
				
				$count=$count+count($streetfixtures); 
				}     
		         for($i=0;$i<30;$i++){	
				if($torgfixtures!=0){
				if(empty($torgfixtures[$i])){}	
				else{	
				$vfr[0]=$torgfixtures[$i];		
				foreach($vfr as $post) {       
				$cheak=$post->getappointmentTwo();
				if($cheak!=$potolochnie){		
				unset($torgfixtures[$i]); 
				}			
				else{		
				 	
				}        
				}	
				}
				}				
				}	
				if($torgfixtures!=0){
				
				$count=$count+count($torgfixtures); 
				}  
				
				for($i=0;$i<30;$i++){	
				if($azsfixtures!=0){
				if(empty($azsfixtures[$i])){}	
				else{	
				$vfr[0]=$azsfixtures[$i];		
				foreach($vfr as $post) {       
				$cheak=$post->getappointmentTwo();
				if($cheak!=$potolochnie){			
				unset($azsfixtures[$i]); 
				}			
				else{		
				 	
				}        
				}	
				}
				}				
				}	
				if($azsfixtures!=0){
				
				$count=$count+count($azsfixtures); 
				}  
					for($i=0;$i<30;$i++){	
				if($officefixtures!=0){
				if(empty($officefixtures[$i])){}	
				else{	
				$vfr[0]=$officefixtures[$i];		
				foreach($vfr as $post) {       
				$cheak=$post->getappointmentTwo();
					if($cheak!=$potolochnie){		
				unset($officefixtures[$i]); 
				}			
				else{		
				 	
				}        
				}	
				}
				}				
				}	
				if($officefixtures!=0){
				
				$count=$count+count($officefixtures); 
				}  
		}
		
		 if($nastennie=="Настенные"){
	            $count=0;	
				for($i=0;$i<30;$i++){	
				if($promfixtures!=0){
				if(empty($promfixtures[$i])){}	
				else{	
				$vfr[0]=$promfixtures[$i];		
				foreach($vfr as $post) {       
				$cheak=$post->getappointmentTwo();
			if($cheak!=$nastennie){		
				unset($promfixtures[$i]); 
				}			
				else{		
				 	
				}        
				}	
				}
				}				
				}	
				if($promfixtures!=0){
				
				$count=$count+count($promfixtures); 
				}
	       	
				for($i=0;$i<30;$i++){	
				if($fitofixtures!=0){
				if(empty($fitofixtures[$i])){}	
				else{	
				$vfr[0]=$fitofixtures[$i];		
				foreach($vfr as $post) {       
				$cheak=$post->getappointmentTwo();
			if($cheak!=$nastennie){			
				unset($fitofixtures[$i]); 
				}			
				else{		
				 	
				}        
				}	
				}
				}				
				}	
				if($fitofixtures!=0){
				
				$count=$count+count($fitofixtures); 
				}     
		         
				 
				 
				 for($i=0;$i<30;$i++){	
				if($streetfixtures!=0){
				if(empty($streetfixtures[$i])){}	
				else{	
				$vfr[0]=$streetfixtures[$i];		
				foreach($vfr as $post) {       
				$cheak=$post->getappointmentTwo();
				if($cheak!=$nastennie){		
				unset($streetfixtures[$i]); 
				}			
				else{		
				 	
				}        
				}	
				}
				}				
				}	
				if($streetfixtures!=0){
				
				$count=$count+count($streetfixtures); 
				}     
		         for($i=0;$i<30;$i++){	
				if($torgfixtures!=0){
				if(empty($torgfixtures[$i])){}	
				else{	
				$vfr[0]=$torgfixtures[$i];		
				foreach($vfr as $post) {       
				$cheak=$post->getappointmentTwo();
				if($cheak!=$nastennie){			
				unset($torgfixtures[$i]); 
				}			
				else{		
				 	
				}        
				}	
				}
				}				
				}	
				if($torgfixtures!=0){
				
				$count=$count+count($torgfixtures); 
				}  
				
				for($i=0;$i<30;$i++){	
				if($azsfixtures!=0){
				if(empty($azsfixtures[$i])){}	
				else{	
				$vfr[0]=$azsfixtures[$i];		
				foreach($vfr as $post) {       
				$cheak=$post->getappointmentTwo();
				if($cheak!=$nastennie){				
				unset($azsfixtures[$i]); 
				}			
				else{		
				 	
				}        
				}	
				}
				}				
				}	
				if($azsfixtures!=0){
				
				$count=$count+count($azsfixtures); 
				}  
					for($i=0;$i<30;$i++){	
				if($officefixtures!=0){
				if(empty($officefixtures[$i])){}	
				else{	
				$vfr[0]=$officefixtures[$i];		
				foreach($vfr as $post) {       
				$cheak=$post->getappointmentTwo();
					if($cheak!=$nastennie){		
				unset($officefixtures[$i]); 
				}			
				else{		
				 	
				}        
				}	
				}
				}				
				}	
				if($officefixtures!=0){
				
				$count=$count+count($officefixtures); 
				}  
		}
		
			 if($sdatchikom=="С датчиком движения"){
	            $count=0;	
				for($i=0;$i<30;$i++){	
				if($promfixtures!=0){
				if(empty($promfixtures[$i])){}	
				else{	
				$vfr[0]=$promfixtures[$i];		
				foreach($vfr as $post) {       
				$cheak=$post->getappointmentTwo();
			if($cheak!=$sdatchikom){	
				unset($promfixtures[$i]); 
				}			
				else{		
				 	
				}        
				}	
				}
				}				
				}	
				if($promfixtures!=0){
				
				$count=$count+count($promfixtures); 
				}
	       	
			    for($i=0;$i<30;$i++){	
				if($projectfixtures!=0){
				if(empty($projectfixtures[$i])){}	
				else{	
				$vfr[0]=$projectfixtures[$i];		
				foreach($vfr as $post) {       
				$cheak=$post->getappointmentTwo();
			if($cheak!=$sdatchikom){	
				unset($projectfixtures[$i]); 
				}			
				else{		
				 	
				}        
				}	
				}
				}				
				}	
				if($projectfixtures!=0){
				
				$count=$count+count($projectfixtures); 
				}
			
				for($i=0;$i<30;$i++){	
				if($fitofixtures!=0){
				if(empty($fitofixtures[$i])){}	
				else{	
				$vfr[0]=$fitofixtures[$i];		
				foreach($vfr as $post) {       
				$cheak=$post->getappointmentTwo();
				if($cheak!=$sdatchikom){	
				unset($fitofixtures[$i]); 
				}			
				else{		
				 	
				}        
				}	
				}
				}				
				}	
				if($fitofixtures!=0){
				
				$count=$count+count($fitofixtures); 
				}     
		         
				 for($i=0;$i<30;$i++){	
				if($streetfixtures!=0){
				if(empty($streetfixtures[$i])){}	
				else{	
				$vfr[0]=$streetfixtures[$i];		
				foreach($vfr as $post) {       
				$cheak=$post->getappointmentTwo();
				if($cheak!=$sdatchikom){	
				unset($streetfixtures[$i]); 
				}			
				else{		
				 	
				}        
				}	
				}
				}				
				}	
				if($streetfixtures!=0){
				
				$count=$count+count($streetfixtures); 
				}     
		         for($i=0;$i<30;$i++){	
				if($torgfixtures!=0){
				if(empty($torgfixtures[$i])){}	
				else{	
				$vfr[0]=$torgfixtures[$i];		
				foreach($vfr as $post) {       
				$cheak=$post->getappointmentTwo();
				if($cheak!=$sdatchikom){		
				unset($torgfixtures[$i]); 
				}			
				else{		
				 	
				}        
				}	
				}
				}				
				}	
				if($torgfixtures!=0){
				
				$count=$count+count($torgfixtures); 
				}  
				
				for($i=0;$i<30;$i++){	
				if($azsfixtures!=0){
				if(empty($azsfixtures[$i])){}	
				else{	
				$vfr[0]=$azsfixtures[$i];		
				foreach($vfr as $post) {       
				$cheak=$post->getappointmentTwo();
					if($cheak!=$sdatchikom){				
				unset($azsfixtures[$i]); 
				}			
				else{		
				 	
				}        
				}	
				}
				}				
				}	
				if($azsfixtures!=0){
				
				$count=$count+count($azsfixtures); 
				}  
					for($i=0;$i<30;$i++){	
				if($officefixtures!=0){
				if(empty($officefixtures[$i])){}	
				else{	
				$vfr[0]=$officefixtures[$i];		
				foreach($vfr as $post) {       
				$cheak=$post->getappointmentTwo();
					if($cheak!=$sdatchikom){		
				unset($officefixtures[$i]); 
				}			
				else{		
				 	
				}        
				}	
				}
				}				
				}	
				if($officefixtures!=0){
				
				$count=$count+count($officefixtures); 
				}  
		}
	 /*         * *        Четвертый блок        ** */	
	  /*         * *        Пятый блок        ** */	
	   if($request->get('amountk')==""){$amountk=0;}
	   else{
	  	 $amountk=$request->get('amountk');
	   }
	   if($request->get('amountkd')==""){$amountkd=100000;}
	   else{
		 $amountkd=$request->get('amountkd');
	   }
	 if($request->get('amountk') || $request->get('amountkd')){
	     if($amountk>0 || $amountkd<100000){
			
				$fitofixtures=array();
				
			
		 }
		
		  $count=0;	
				for($i=0;$i<30;$i++){	
				if($promfixtures!=0){
				if(empty($promfixtures[$i])){}	
				else{	
				$vfr[0]=$promfixtures[$i];		
				foreach($vfr as $post) {       
				$cheak=$post->getlightflow();
				
				if($cheak<=$amountkd and $cheak>=$amountk){	
				
				}			
				else{		
				unset($promfixtures[$i]);  	
				}        
				}	
				}
				}				
				}	
				if($promfixtures!=0){
				
				$count=$count+count($promfixtures); 
				}
		 
		        for($i=0;$i<30;$i++){	
				if($projectfixtures!=0){
				if(empty($projectfixtures[$i])){}	
				else{	
				$vfr[0]=$projectfixtures[$i];		
				foreach($vfr as $post) {       
				$cheak=$post->getlightflow();
				
				if($cheak<=$amountkd and $cheak>=$amountk){	
				
				}			
				else{		
				unset($projectfixtures[$i]);  	
				}        
				}	
				}
				}				
				}	
				if($projectfixtures!=0){
				
				$count=$count+count($projectfixtures); 
				}
		 
		        for($i=0;$i<30;$i++){	
				if($officefixtures!=0){
				if(empty($officefixtures[$i])){}	
				else{	
				$vfr[0]=$officefixtures[$i];		
				foreach($vfr as $post) {       
				$cheak=$post->getlightflow();
				
				if($cheak<=$amountkd and $cheak>=$amountk){	
				
				}			
				else{		
				unset($officefixtures[$i]);  	
				}        
				}	
				}
				}				
				}	
				if($officefixtures!=0){
				
				$count=$count+count($officefixtures); 
				}
				
				 for($i=0;$i<30;$i++){	
				if($torgfixtures!=0){
				if(empty($torgfixtures[$i])){}	
				else{	
				$vfr[0]=$torgfixtures[$i];		
				foreach($vfr as $post) {       
				$cheak=$post->getlightflow();
				
				if($cheak<=$amountkd and $cheak>=$amountk){	
				
				}			
				else{		
				unset($torgfixtures[$i]);  	
				}        
				}	
				}
				}				
				}	
				if($torgfixtures!=0){
				
				$count=$count+count($torgfixtures); 
				}
		 
		        for($i=0;$i<30;$i++){	
				if($streetfixtures!=0){
				if(empty($streetfixtures[$i])){}	
				else{	
				$vfr[0]=$streetfixtures[$i];		
				foreach($vfr as $post) {       
				$cheak=$post->getlightflow();
				
				if($cheak<=$amountkd and $cheak>=$amountk){	
				
				}			
				else{		
				unset($streetfixtures[$i]);  	
				}        
				}	
				}
				}				
				}	
				if($streetfixtures!=0){
				
				$count=$count+count($streetfixtures); 
				}
				
				for($i=0;$i<30;$i++){	
				if($azsfixtures!=0){
				if(empty($azsfixtures[$i])){}	
				else{	
				$vfr[0]=$azsfixtures[$i];		
				foreach($vfr as $post) {       
				$cheak=$post->getlightflow();
				
				if($cheak<=$amountkd and $cheak>=$amountk){	
				
				}			
				else{		
				unset($azsfixtures[$i]);  	
				}        
				}	
				}
				}				
				}	
				if($azsfixtures!=0){
				
				$count=$count+count($azsfixtures); 
				}
				
				if($fitofixtures!=0){$count=$count+count($fitofixtures); }
		
		
	 }
	 if(isset($_POST['index'])==""){
		 $index=7;
		 
	 }
	 else{
$index=$request->get('index');
	 }
	 $knopka=0;
$index2=$index;	 
$result=array_merge($promfixtures, $officefixtures,$torgfixtures,$streetfixtures,$fitofixtures,$azsfixtures,$projectfixtures,$vipfixtures);
    $countindex=count($result);
	for($index;$index<$countindex;$index++){
	unset($result[$index]);
	}
$countindex2=count($result);
if(	$countindex-$countindex2<=0){
	
	$knopka=1;
}

$cheak=1;
		   return $this->render('ProjectBundle:Default:fixtures.html.twig', array(''
						. 'result' => $result, ''
                        . 'count' => $countindex, ''
                        . 'inputFielsd' => $inputFields, ''
						. 'amountk' => $amountk, ''
						. 'amountkd' => $amountkd, ''
						. 'cheak' => $cheak, ''
						. 'index' => $index2, ''
						. 'knopka' => $knopka));
        }
       

	   
	   
    /**
     * @Route("/fixtures/prom/{id}", name="fullPromFixture")
     */
    public function listFullPromFixture($id) {
	$rull=0;
	if(isset($_POST['name'])&&$_POST['name']!="" && isset($_POST['phone']) && $_POST['phone']!=""&& isset($_POST['mail'])&&$_POST['mail']!=""&&isset($_POST['towarname'])&&$_POST['towarname']!=""){ //Проверка отправилось ли наше поля name и не пустые ли они
        $to = '7081313@gmail.com'; //Почта получателя, через запятую можно указать сколько угодно адресов
        $subject = 'Обратный звонок'; //Загаловок сообщения
	    $rull=1;
        $message = '
                <html>
                    <head>
                        <title>'.$subject.'</title>
                    </head>
                    <body>
                        <p>Имя: '.$_POST['name'].'</p>
                        <p>Телефон: '.$_POST['phone'].'</p>               
                        <p>e-mail: '.$_POST['mail'].'</p> 
						<p>Товар: '.$_POST['towarname'].'</p> 
                    </body>
                </html>'; //Текст нащего сообщения можно использовать HTML теги
        $headers  = "Content-type: text/html; charset=utf-8 \r\n"; //Кодировка письма
        $headers .= "From: Отправитель <admin@ol1.by>\r\n"; //Наименование и почта отправителя
        mail($to, $subject, $message, $headers); //Отправка письма с помощью функции mail

}
        $fixture = $this->getDoctrine()->getRepository('ProjectBundle:promFixture')
                ->findOneBy(array('id' => $id));
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery(
                        'SELECT p
    FROM ProjectBundle:promFixture p 
    WHERE p.id != :id'
                )->setParameter('id', $id);

        $similarFixtures = $query->getResult();
       
        if (!$fixture) {
            return $this->redirectToRoute('home');
        }
		shuffle($similarFixtures);
        return $this->render('ProjectBundle:Default:fullPromFixture.html.twig', array(''
                    . 'fixture' => $fixture, ''
                    . 'similarFixtures' => $similarFixtures, ''
					. 'id' => $id, ''
					. 'rull' => $rull));
        
    }

	 /**
     * @Route("/fixtures/project/{id}", name="fullProjectFixture")
     */
    public function listFullProjectFixture($id) {
	$rull=0;
	if(isset($_POST['name'])&&$_POST['name']!="" && isset($_POST['phone']) && $_POST['phone']!=""&& isset($_POST['mail'])&&$_POST['mail']!=""&&isset($_POST['towarname'])&&$_POST['towarname']!=""){ //Проверка отправилось ли наше поля name и не пустые ли они
        $to = '7081313@gmail.com'; //Почта получателя, через запятую можно указать сколько угодно адресов
        $subject = 'Обратный звонок'; //Загаловок сообщения
	    $rull=1;
        $message = '
                <html>
                    <head>
                        <title>'.$subject.'</title>
                    </head>
                    <body>
                        <p>Имя: '.$_POST['name'].'</p>
                        <p>Телефон: '.$_POST['phone'].'</p>               
                        <p>e-mail: '.$_POST['mail'].'</p> 
						<p>Товар: '.$_POST['towarname'].'</p> 
                    </body>
                </html>'; //Текст нащего сообщения можно использовать HTML теги
        $headers  = "Content-type: text/html; charset=utf-8 \r\n"; //Кодировка письма
        $headers .= "From: Отправитель <admin@ol1.by>\r\n"; //Наименование и почта отправителя
        mail($to, $subject, $message, $headers); //Отправка письма с помощью функции mail

}
        $fixture = $this->getDoctrine()->getRepository('ProjectBundle:projectFixture')
                ->findOneBy(array('id' => $id));
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery(
                        'SELECT p
    FROM ProjectBundle:projectFixture p 
    WHERE p.id != :id'
                )->setParameter('id', $id);

        $similarFixtures = $query->getResult();
       
        if (!$fixture) {
            return $this->redirectToRoute('home');
        }
		shuffle($similarFixtures);
        return $this->render('ProjectBundle:Default:fullProjectFixture.html.twig', array(''
                    . 'fixture' => $fixture, ''
                    . 'similarFixtures' => $similarFixtures, ''
					. 'id' => $id, ''
					. 'rull' => $rull));
        
    }

    /**
     * @Route("/fixtures/office/{id}", name="fullOfficeFixture")
     */
    public function listFullOfficeFixture($id) {
		$rull=0;
if(isset($_POST['name'])&& $_POST['name']!="" && $_POST['name']!="Имя"&& $_POST['phone']!="Мобильный" && $_POST['mail']!="E-mail" && isset($_POST['phone']) && $_POST['phone']!=""&& isset($_POST['mail'])&&$_POST['mail']!=""&&isset($_POST['towarname'])&&$_POST['towarname']!=""){ //Проверка отправилось ли наше поля name и не пустые ли они
        $to = '7081313@gmail.com'; //Почта получателя, через запятую можно указать сколько угодно адресов
        $subject = 'Обратный звонок'; //Загаловок сообщения
	    $rull=1;
        $message = '
                <html>
                    <head>
                        <title>'.$subject.'</title>
                    </head>
                    <body>
                        <p>Имя: '.$_POST['name'].'</p>
                        <p>Телефон: '.$_POST['phone'].'</p>               
                        <p>e-mail: '.$_POST['mail'].'</p> 
						<p>Товар: '.$_POST['towarname'].'</p> 
                    </body>
                </html>'; //Текст нащего сообщения можно использовать HTML теги
        $headers  = "Content-type: text/html; charset=utf-8 \r\n"; //Кодировка письма
        $headers .= "From: Отправитель <admin@ol1.by>\r\n"; //Наименование и почта отправителя
        mail($to, $subject, $message, $headers); //Отправка письма с помощью функции mail
}
        $fixture = $this->getDoctrine()->getRepository('ProjectBundle:officeFixture')
                ->findOneBy(array('id' => $id));
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery(
                        'SELECT p
    FROM ProjectBundle:officeFixture p
    WHERE p.id != :id'
                )->setParameter('id', $id);

        $similarFixtures = $query->getResult();

        if (!$fixture) {
            return $this->redirectToRoute('home');
        }
		shuffle($similarFixtures);
        return $this->render('ProjectBundle:Default:fullOfficeFixture.html.twig', array(''
                    . 'fixture' => $fixture, ''
                    . 'similarFixtures' => $similarFixtures, ''
					. 'id' => $id, ''
					. 'rull' => $rull));
					
    }

    /**
     * @Route("/fixtures/torg/{id}", name="fullTorgFixture")
     */
    public function listFullTorgFixture($id) {
		$rull=0;
if(isset($_POST['name'])&& $_POST['name']!="" && $_POST['name']!="Имя"&& $_POST['phone']!="Мобильный" && $_POST['mail']!="E-mail" && isset($_POST['phone']) && $_POST['phone']!=""&& isset($_POST['mail'])&&$_POST['mail']!=""&&isset($_POST['towarname'])&&$_POST['towarname']!=""){ //Проверка отправилось ли наше поля name и не пустые ли они
        $to = '7081313@gmail.com'; //Почта получателя, через запятую можно указать сколько угодно адресов
        $subject = 'Обратный звонок'; //Загаловок сообщения
	    $rull=1;
        $message = '
                <html>
                    <head>
                        <title>'.$subject.'</title>
                    </head>
                    <body>
                        <p>Имя: '.$_POST['name'].'</p>
                        <p>Телефон: '.$_POST['phone'].'</p>               
                        <p>e-mail: '.$_POST['mail'].'</p> 
						<p>Товар: '.$_POST['towarname'].'</p> 
                    </body>
                </html>'; //Текст нащего сообщения можно использовать HTML теги
        $headers  = "Content-type: text/html; charset=utf-8 \r\n"; //Кодировка письма
        $headers .= "From: Отправитель <admin@ol1.by>\r\n"; //Наименование и почта отправителя
        mail($to, $subject, $message, $headers); //Отправка письма с помощью функции mail
}
        $fixture = $this->getDoctrine()->getRepository('ProjectBundle:torgFixture')
                ->findOneBy(array('id' => $id));
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery(
                        'SELECT p
    FROM ProjectBundle:torgFixture p
    WHERE p.id != :id'
                )->setParameter('id', $id);

        $similarFixtures = $query->getResult();

        if (!$fixture) {
            return $this->redirectToRoute('home');
        }
		shuffle($similarFixtures);
        return $this->render('ProjectBundle:Default:fullTorgFixture.html.twig', array(''
                    . 'fixture' => $fixture, ''
                    . 'similarFixtures' => $similarFixtures, ''
					. 'id' => $id, ''
					. 'rull' => $rull));
    }

    /**
     * @Route("/fixtures/street/{id}", name="fullStreetFixture")
     */
    public function listFullStreetFixture($id) {
		$rull=0;
if(isset($_POST['name'])&& $_POST['name']!="" && $_POST['name']!="Имя"&& $_POST['phone']!="Мобильный" && $_POST['mail']!="E-mail" && isset($_POST['phone']) && $_POST['phone']!=""&& isset($_POST['mail'])&&$_POST['mail']!=""&&isset($_POST['towarname'])&&$_POST['towarname']!=""){ //Проверка отправилось ли наше поля name и не пустые ли они
        $to = '7081313@gmail.com'; //Почта получателя, через запятую можно указать сколько угодно адресов
        $subject = 'Обратный звонок'; //Загаловок сообщения
	    $rull=1; 
        $message = '
                <html>
                    <head>
                        <title>'.$subject.'</title>
                    </head>
                    <body>
                        <p>Имя: '.$_POST['name'].'</p>
                        <p>Телефон: '.$_POST['phone'].'</p>               
                        <p>e-mail: '.$_POST['mail'].'</p> 
						<p>Товар: '.$_POST['towarname'].'</p> 
                    </body>
                </html>'; //Текст нащего сообщения можно использовать HTML теги
        $headers  = "Content-type: text/html; charset=utf-8 \r\n"; //Кодировка письма
        $headers .= "From: Отправитель <admin@ol1.by>\r\n"; //Наименование и почта отправителя
        mail($to, $subject, $message, $headers); //Отправка письма с помощью функции mail
}
        $fixture = $this->getDoctrine()->getRepository('ProjectBundle:streetFixture')
                ->findOneBy(array('id' => $id));
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery(
                        'SELECT p
    FROM ProjectBundle:streetFixture p
    WHERE p.id != :id'
                )->setParameter('id', $id);

        $similarFixtures = $query->getResult();

        if (!$fixture) {
            return $this->redirectToRoute('home');
        }
		shuffle($similarFixtures);
        return $this->render('ProjectBundle:Default:fullStreetFixture.html.twig', array(''
                    . 'fixture' => $fixture, ''
                    . 'similarFixtures' => $similarFixtures, ''
					. 'id' => $id, ''
					. 'rull' => $rull));
    }

    /**
     * @Route("/fixtures/fito/{id}", name="fullFitoFixture")
     */
    public function listFullFitoFixture($id) {
		$rull=0;
if(isset($_POST['name'])&& $_POST['name']!="" && $_POST['name']!="Имя"&& $_POST['phone']!="Мобильный" && $_POST['mail']!="E-mail" && isset($_POST['phone']) && $_POST['phone']!=""&& isset($_POST['mail'])&&$_POST['mail']!=""&&isset($_POST['towarname'])&&$_POST['towarname']!=""){ //Проверка отправилось ли наше поля name и не пустые ли они
        $to = '7081313@gmail.com'; //Почта получателя, через запятую можно указать сколько угодно адресов
        $subject = 'Обратный звонок'; //Загаловок сообщения
	    $rull=1;
        $message = '
                <html>
                    <head>
                        <title>'.$subject.'</title>
                    </head>
                    <body>
                        <p>Имя: '.$_POST['name'].'</p>
                        <p>Телефон: '.$_POST['phone'].'</p>               
                        <p>e-mail: '.$_POST['mail'].'</p> 
						<p>Товар: '.$_POST['towarname'].'</p> 
                    </body>
                </html>'; //Текст нащего сообщения можно использовать HTML теги
        $headers  = "Content-type: text/html; charset=utf-8 \r\n"; //Кодировка письма
        $headers .= "From: Отправитель <admin@ol1.by>\r\n"; //Наименование и почта отправителя
        mail($to, $subject, $message, $headers); //Отправка письма с помощью функции mail
}
        $fixture = $this->getDoctrine()->getRepository('ProjectBundle:fitoFixture')
                ->findOneBy(array('id' => $id));
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery(
                        'SELECT p
    FROM ProjectBundle:fitoFixture p
    WHERE p.id != :id'
                )->setParameter('id', $id);

        $similarFixtures = $query->getResult();


        if (!$fixture) {
            return $this->redirectToRoute('home');
        }
		shuffle($similarFixtures);
        return $this->render('ProjectBundle:Default:fullFitoFixture.html.twig', array(''
                    . 'fixture' => $fixture, ''
                    . 'similarFixtures' => $similarFixtures, ''
					. 'id' => $id, ''
					. 'rull' => $rull));
    }

    /**
     * @Route("/fixtures/azs/{id}", name="fullAzsFixture")
     */
    public function listFullAzsFixture($id) {
		$rull=0;
	if(isset($_POST['name'])&& $_POST['name']!="" && $_POST['name']!="Имя"&& $_POST['phone']!="Мобильный" && $_POST['mail']!="E-mail" && isset($_POST['phone']) && $_POST['phone']!=""&& isset($_POST['mail'])&&$_POST['mail']!=""&&isset($_POST['towarname'])&&$_POST['towarname']!=""){ //Проверка отправилось ли наше поля name и не пустые ли они
        $to = '7081313@gmail.com'; //Почта получателя, через запятую можно указать сколько угодно адресов
        $subject = 'Обратный звонок'; //Загаловок сообщения
	    $rull=1;
        $message = '
                <html>
                    <head>
                        <title>'.$subject.'</title>
                    </head>
                    <body>
                        <p>Имя: '.$_POST['name'].'</p>
                        <p>Телефон: '.$_POST['phone'].'</p>               
                        <p>e-mail: '.$_POST['mail'].'</p> 
						<p>Товар: '.$_POST['towarname'].'</p> 
                    </body>
                </html>'; //Текст нащего сообщения можно использовать HTML теги
        $headers  = "Content-type: text/html; charset=utf-8 \r\n"; //Кодировка письма
        $headers .= "From: Отправитель <admin@ol1.by>\r\n"; //Наименование и почта отправителя
        mail($to, $subject, $message, $headers); //Отправка письма с помощью функции mail
}
        $fixture = $this->getDoctrine()->getRepository('ProjectBundle:azsFixture')
                ->findOneBy(array('id' => $id));
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery(
                        'SELECT p
    FROM ProjectBundle:azsFixture p
    WHERE p.id != :id'
                )->setParameter('id', $id);

        $similarFixtures = $query->getResult();

        if (!$fixture) {
            return $this->redirectToRoute('home');
        }
		shuffle($similarFixtures);
        return $this->render('ProjectBundle:Default:fullAzsFixture.html.twig', array(''
                    . 'fixture' => $fixture, ''
                    . 'similarFixtures' => $similarFixtures, ''
					. 'id' => $id, ''
					. 'rull' => $rull));
    }

  
    
	 /**
     * @Route("/lampa", name="lampa")
     */
    public function listLampaAction() {
        return $this->render('ProjectBundle:Default:lampa.html.twig');
    }
	
	 /**
     * @Route("/lenta", name="lenta")
     */
    public function listLentaAction() {
        return $this->render('ProjectBundle:Default:lenta.html.twig');
    }
	
	 /**
     * @Route("/work", name="work")
     */
    public function listWorkAction() {
        return $this->render('ProjectBundle:Default:work.html.twig');
    }
	
	/**
     * @Route("/profil", name="profil")
     */
    public function listProfilAction() {
        return $this->render('ProjectBundle:Default:profil.html.twig');
    }
	
	/**
     * @Route("/opora", name="opora")
     */
    public function listOporaAction() {
        return $this->render('ProjectBundle:Default:opora.html.twig');
    }
	
		/**
     * @Route("/newyear", name="newyear")
     */
    public function listNewyearAction() {
        return $this->render('ProjectBundle:Default:newyear.html.twig');
    }
	
		/**
     * @Route("/schit", name="schit")
     */
    public function listSchitAction() {
        return $this->render('ProjectBundle:Default:schit.html.twig');
    }
	

}

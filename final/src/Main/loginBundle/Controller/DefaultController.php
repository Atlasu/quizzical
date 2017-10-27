<?php

namespace Main\loginBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Main\loginBundle\Entity\Entidade;
use Main\loginBundle\Entity\Evento;
use Main\loginBundle\Modals\Login;
use Main\loginBundle\Entity\Quizz;
use Main\loginBundle\Entity\Questao;
use Main\loginBundle\Form\Type\QuizzType;
use Main\loginBundle\Modals\FBplach;
use Main\loginBundle\Entity\Eventocred;

class DefaultController extends Controller
{
    public function loginfacebookAction(Request $request)
    {
        if($request->getMethod()=='POST')
        {
            $session = $request->getSession();
            $session->clear();
            $username = $request->get('id');
            if($this->assertLogin($username, 1, null))
            {
                $login = new Login();
                $login->setUsername($username);
                $mode = 1;
                $login->setMode($mode);
                $session->set('login_entidade',$login);
                return $this->redirectToRoute('login_homepage');
            }
            else
            {
                return $this->redirectToRoute('login_errorlogin');
            }
        }
    }
    
    public function assertForm($name, $formname, $type)
    {
        $doador = $this->getDoctrine()->getManager()->getRepository($type)->findOnebY(array($formname=>$name));
        if($doador)
        {
            return false;
        }
        else
        {
            return true; // BD livre
        }
    }
    
    public function errorloginAction()
    {
        return $this->render('loginBundle:Default:loginuser.html.twig', array('name2' => 'Login Error'));
    }
    
    public function facebookregAction(Request $request)
    {
        if($request->getMethod()=='POST')
        {
            $session = $request->getSession();
            $session->clear();
            $username = $request->get('id');
            $fbp = new FBplach();
            $fbp->setId($username);
            $session->set('fb_plach',$fbp);
            return $this->redirectToRoute('login_entidadereg');
        }
        else
        {
            return $this->redirectToRoute('login_homepage');
        }
    }
    
    public function eventoeditAction(Request $request)
    {
        if($request->getMethod()=='POST')
        {
            $em = $this->getDoctrine()->getManager();
            $id = $request->get('id');
            $evento=$em->getRepository('loginBundle:Evento')->findOneBy(array('id'=>$id));
            if($evento)
            {
                return $this->render('loginBundle:Default:formevento.html.twig', array('logged'=>'logged', 'evento'=>$evento));
            }
        }
        return $this->redirectToRoute('login_eventolista');
    }
    
    public function eventodestroyAction(Request $request)
    {
        if($request->getMethod()=='POST')
        {
            $em = $this->getDoctrine()->getManager();
            $id = $request->get('id');
            $quizz=$em->getRepository('loginBundle:Quizz')->findOneBy(array('id'=>$id));
            $em->remove($quizz);
            $em->flush();
            $questoes=$em->getRepository('loginBundle:Questao')->findBy(array('idquizz'=>$id));
            foreach ($questoes as $row) {
                $em->remove($row);
                $em->flush();
            }
            return $this->redirectToRoute('login_eventolista');
        }
        return $this->redirectToRoute('login_eventolista');
    }
    
    public function indexAction(Request $request)
    {
        if($this->isLogged($request))
        {
            return $this->render('loginBundle:Default:index.html.twig', array('logged' => 'logged'));
        }
        else
        {
            return $this->render('loginBundle:Default:index.html.twig', array('logged' => 'notlogged'));
        }
    }
    
    public function assertLogin($id, $mode, $password)
    {
        if($mode==0)
        {
            return $this->getDoctrine()->getManager()->getRepository('loginBundle:Entidade')->findOnebY(array('email'=>$id,'password'=>$password));
        }
        else
        {
            return $this->getDoctrine()->getManager()->getRepository('loginBundle:Entidade')->findOnebY(array('idfacebook'=>$id));
        }
    }
    
    public function profileAction()
    {
        if($this->isLogged($request))
        {
            $entidade=$this->getEntidade();
            $nome=$entidade->getNome();
            $cidade=$entidade->getCidade();
            $descricao=$entidade->getDescricao();
            $email=$entidade->getEmail();
            return $this->render('loginBundle:Default:profileentidade.html.twig', array('nome'=>$nome,'cidade'=>$cidade,'email'=>$email,'descricao'=>$descricao));
        }
        else
        {
            return $this->redirectToRoute('login_homepage');
        }
    }
    
    public function logoutAction(Request $request)
    {
        $session=$request->getSession();
        $session->clear();
        return $this->redirectToRoute('login_homepage');        
    }
    
    public function clearAction(Request $request)
    {
        $session=$request->getSession();
        $session->clear();
        return $this->redirectToRoute('login_entidadereg');        
    }
    
    public function openQuizzes()
    {
        $em = $this->getDoctrine()->getManager();
        $quizzes = $em->getRepository('loginBundle:Quizz');
        $arraytotal = $quizzes->findAll();
        return $arraytotal;
    }
    
    public function bdhandling($eventocreds)
    {
        $arraytotal = array();
        foreach ($eventocreds as $row) {
            $eventoid=$row->getIdevento();
            $em = $this->getDoctrine()->getManager();
            $eventos = $em->getRepository('loginBundle:Evento');
            $arraytotal[] = $eventos->findOneBy(array('id'=>$eventoid));
        }
        return $arraytotal;
    }
    
    public function bdhandlingPresenca($presenca)
    {
        $arraytotal = array();
        foreach ($presenca as $row) {
            $iddoador=$row->getIddoador();
            $em = $this->getDoctrine()->getManager();
            $eventos = $em->getRepository('loginBundle:Doador');
            $arraytotal[] = $eventos->findOneBy(array('id'=>$iddoador));
        }
        return $arraytotal;
    }
    
   
    
    public function getUserusername()
    {
        $session=$this->getRequest()->getSession();
        $login = $session->get('login_entidade');
        $username = $login->getUsername();
        return $username;
    }
    
    public function getEntidade()
    {
        $session=$this->getRequest()->getSession();
        $login = $session->get('login_entidade');
        $username = $login->getUsername();
        $mode = $login->getMode();
        $em = $this->getDoctrine()->getManager();
        $entidades = $em->getRepository('loginBundle:Entidade');
        if($mode==0)
        {
            $entidade = $entidades->findOneBy(array('email'=>$username));
        }
        else
        {
            $entidade = $entidades->findOneBy(array('idfacebook'=>$username));
        }
        return $entidade;
    }
    
    public function eventolistaAction(Request $request)
    {
        
        $em = $this->getDoctrine()->getManager();
        $quizzes = $em->getRepository('loginBundle:Quizz');
        if($quizzes) 
        {    
            $arr = $this->openQuizzes();
        }
        else
        { 
            $arr=null;
        }
        if(!($this->isLogged($request))) {
            return $this->render('loginBundle:Default:listaevento.html.twig', array('logged' => 'notlogged', 'quizzes' => $arr) );
        }
        else
        {
            return $this->render('loginBundle:Default:listaevento.html.twig', array('logged' => 'logged', 'quizzes' => $arr) );
        }
    }
    
    public function loginAction(Request $request)
    {
        if(!($this->isLogged($request))) // se nao esta logado
        {
            $session=$request->getSession();
            if($request->getMethod()=='POST')
            {
                $session->clear();
                $email=$request->get('email');
                $password=md5($request->get('password'));
                $usr = $this->assertLogin($email, 0, $password);
                if($usr) // o usuario esta no BD
                {
                    $login = new Login();
                    $mode = 0;
                    $login->setMode($mode);
                    $login->setUsername($email);
                    $session->set('login_entidade',$login);
                    return $this->redirectToRoute('login_homepage');
                }
                else
                {
                    return $this->render('loginBundle:Default:loginuser.html.twig', array('name' => 'Login Error'));
                }
            }
            else // cara n deu post e n esta logado
            {
                return $this->render('loginBundle:Default:loginuser.html.twig');
            }
        }
        else
        {
            return $this->redirectToRoute('login_homepage'); // cara ja ta logado e esta tentando logar, wtf?
        }
    }
    
    public function saveEntidade(Request $request)
    {
        $entidade = new Entidade();
        $cidade=$request->get('cidade');
        $estado=$request->get('estado');
        $username=$request->get('username');
        $password=md5($request->get('password'));
        //$cnpj=$request->get('cnpj');    
        $email=$request->get('email');    
        $descricao=$request->get('descricao'); 
        $idfacebook=$request->get('idfacebook'); 
        $estado=$request->get('estado');
        $array = array();
        $array['fbid']=$request->getSession()->get('fb_plach')->getId();
        $error=0;
        if(!$this->assertForm($username, 'nome', 'loginBundle:Entidade'))
        {
            $error=1;
            $array['error2']='true';
        }
        if(!$this->assertForm($idfacebook, 'idfacebook', 'loginBundle:Entidade'))
        {
            $error=1;
            $array['error1']='true';
        }
        if(!$this->assertForm($email, 'email', 'loginBundle:Entidade'))
        {
            $error=1;
            $array['error3']='true';
        }
        if(!$error)
        {
            $entidade->setPassword($password);
            $entidade->setCidade($cidade);
            $entidade->setEstado($estado);
            $entidade->setNome($username);
            $entidade->setEmail($email);
            $entidade->setIdfacebook($idfacebook);
            $entidade->setEstado($estado);
            $entidade->setCnpj('aleatorio');
            $entidade->setDescricao($descricao);

            $em = $this->getDoctrine()->getManager();
            $em->persist($entidade);
            $em->flush();
            $request->getSession()->clear();
            return $this->render('loginBundle:Default:regsucess.html.twig');  
        }
        else
        {
            return $this->render('loginBundle:Default:formentidade.html.twig', $array);
        }
    }
    
    public function entidaderegAction(Request $request)
    {
        if($this->isLogged($request))
        {
            return $this->redirectToRoute('login_homepage'); // cara ja ta logado e esta tentando registrar
        }
        else
        {
            if($request->getMethod()=='POST')
            {
                return $this->saveEntidade($request);
            }
            else
            {
                if($request->getSession()->has('fb_plach'))
                {
                    return $this->render('loginBundle:Default:formentidade.html.twig', array('fbid'=>$request->getSession()->get('fb_plach')->getId()));
                }
                else
                {
                    return $this->render('loginBundle:Default:formentidade.html.twig');
                }
                
            }
        } 
    }
    
    public function isLogged(Request $request)
    {
        $session=$request->getSession();
        if($session->has('login_entidade'))
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    
    public function saveEvento(Request $request)
    {
        $cidade=$request->get('cidade');
        $nome=$request->get('nome');
        $rua=$request->get('rua');    
        $bairro=$request->get('bairro');    
        $numero=$request->get('numero');  
        $estado=$request->get('estado');  
        $complemento=$request->get('complemento');    
        $descricao=$request->get('descricao');   
        $linkfacebook=$request->get('linkfacebook');
        $horainicio=$request->get('horainicio');    
        $horafim=$request->get('horafim');    
        $datainicio=$request->get('datainicio');   
        $datafim=$request->get('datafim');
        $datafim2 = new \DateTime($datafim);
        $datainicio2 = new \DateTime($datainicio);
        $horafim2 = new \DateTime($horafim);
        $horainicio2 = new \DateTime($horainicio);
        $edit = $request->get('edit');
        $em = $this->getDoctrine()->getManager();
        if($edit==-1)
        {
            if($this->assertForm($nome,'nome','loginBundle:Evento'))
            {
                $evento = new Evento();
                $evento->setNome($nome);
                $evento->setCidade($cidade);
                $evento->setEstado($estado);
                $evento->setRua($rua);
                $evento->setBairro($bairro);
                $evento->setNumero($numero);
                $evento->setComplemento($complemento);
                $evento->setDescricao($descricao);
                $evento->setLinkfacebook($linkfacebook);
                $evento->setDatainicio($datainicio2);
                $evento->setHorafim($horafim2);
                $evento->setHorainicio($horainicio2);
                $evento->setDatafim($datafim2);
                $evento->setEstado($estado);
                $em->persist($evento);     
            }
            else
            {
                return $this->render('loginBundle:Default:formevento.html.twig', array('logged'=>'logged','evento'=>null, 'error1'=>'true'));
            }
        }
        else
        {
            $editid = $request->get('evid');
            $evento = $em->getRepository('loginBundle:Evento')->findOneBy(array('id'=>$editid));
            if($this->assertForm($nome,'nome','loginBundle:Evento'))
            { // mudou pra um nome novo
                $evento->setNome($nome);
                $evento->setCidade($cidade);
                $evento->setEstado($estado);
                $evento->setRua($rua);
                $evento->setBairro($bairro);
                $evento->setNumero($numero);
                $evento->setComplemento($complemento);
                $evento->setDescricao($descricao);
                $evento->setLinkfacebook($linkfacebook);
                $evento->setDatainicio($datainicio2);
                $evento->setHorafim($horafim2);
                $evento->setHorainicio($horainicio2);
                $evento->setDatafim($datafim2);
            }
            else
            {
                if($nome == $evento->getNome())
                {  // nao mudou o nome
                    $evento->setNome($nome);
                    $evento->setCidade($cidade);
                    $evento->setEstado($estado);
                    $evento->setRua($rua);
                    $evento->setBairro($bairro);
                    $evento->setNumero($numero);
                    $evento->setComplemento($complemento);
                    $evento->setDescricao($descricao);
                    $evento->setLinkfacebook($linkfacebook);
                    $evento->setDatainicio($datainicio2);
                    $evento->setHorafim($horafim2);
                    $evento->setHorainicio($horainicio2);
                    $evento->setDatafim($datafim2);
                }
                else
                {
                    return $this->render('loginBundle:Default:formevento.html.twig', array('logged'=>'logged','evento'=>$evento, 'error2'=>'true'));
                }
            }
        } 
        $em->flush();
        $this->saveEventocred($request); 
        return $this->render('loginBundle:Default:evenregsucess.html.twig');
    }
    
    public function saveEventocred(Request $request)
    {
        $edit = $request->get('edit');
        if($edit==-1)
        {
            $entidade = $this->getEntidade();
            $identidade=$entidade->getId(); // pega no BD o ID da entidade

            $em = $this->getDoctrine()->getManager();
            $repositoryEve = $em->getRepository('loginBundle:Evento'); 
            $linkfacebook=$request->get('linkfacebook');
            $evento = $repositoryEve->findOneBy(array('linkfacebook'=>$linkfacebook)); 
            $idevento=$evento->getId(); // pega no BD o ID do evento

            $eventocredentials = new Eventocred();
            $eventocredentials->setIdentidade($identidade);
            $eventocredentials->setIdevento($idevento);
            $em->persist($eventocredentials);
            $em->flush(); // salva no BD a relação
        }
    }
    
    public function eventoregAction(Request $request)
    {
        if($this->isLogged($request))
        {
            $quizz = new Quizz();
            $que1 = new Questao();
            $que1->name = 'que1';
            $quizz->getQuestoes()->add($que1);

            $form = $this->createForm(new QuizzType(), $quizz);
            $form->handleRequest($request);
            
            if ($form->isSubmitted() && $form->isValid()) {
                // $form->getData() holds the submitted values
                // but, the original `$task` variable has also been updated
                $em = $this->getDoctrine()->getManager();
                //$quizzz = $form->getData();
                $em->persist($quizz);
                $em->flush();
                $quizznome = $quizz->getNome();
                $quizzid = $em->getRepository('loginBundle:Quizz')->findOneBy(array('nome'=>$quizznome))->getId();
                $questoes = $quizz->getQuestoes();
                foreach ($questoes as $questao) {
                    $questao->setIdquizz($quizzid);
                    if($questao->getAnswer()=='a') $questao->setAnswer($questao->getAlta());
                    else if($questao->getAnswer()=='b') $questao->setAnswer($questao->getAltb());
                    else if($questao->getAnswer()=='c') $questao->setAnswer($questao->getAltc());
                    else if($questao->getAnswer()=='d') $questao->setAnswer($questao->getAltd());
                    $em->persist($questao);
                }
                $em->flush();

                return $this->render('loginBundle:Default:quizzregsucess.html.twig'); 
            }
            
            return $this->render('loginBundle:Default:formevento.html.twig', array('logged'=>'logged','evento'=>null,'form' => $form->createView(),
            ));
        }
        else
        {
            return $this->redirectToRoute('login_homepage');
        }
    }
    
    public function saveQuestao(Request $request)
    {
        return $this->redirectToRoute('login_eventoreg');
    }
    
    public function eventoAction(Request $request, $idquizz)
    {
        $em = $this->getDoctrine()->getManager();
        $quizzrep = $em->getRepository('loginBundle:Quizz'); 
        $quizz = $quizzrep->findOneBy(array('id'=>$idquizz)); 
        if($quizz)
        {
            $questoesrep = $em->getRepository('loginBundle:Questao'); 
            $arr = $questoesrep->findBy(array('idquizz'=>$idquizz)); 
            if($this->isLogged($request))
            {
                return $this->render('loginBundle:Default:visualizarevento.html.twig', 
                        array('logged' => 'logged', 'quizz' => $quizz , 'questoes' => $arr));
            }
            else
            {
                return $this->render('loginBundle:Default:visualizarevento.html.twig', 
                        array('logged' => 'notlogged', 'quizz' => $quizz , 'questoes' => $arr));
            }

        }
        else
        {
            return $this->redirectToRoute('login_notfound');
        }
    }
    
    public function checaquizzAction(Request $request, $idquizz)
    {
        if($request->getMethod()=='POST')
        {
            $em = $this->getDoctrine()->getManager();
            $quizzrep = $em->getRepository('loginBundle:Quizz'); 
            $quizz = $quizzrep->findOneBy(array('id'=>$idquizz));
            if($quizz)
            {
                $questoesrep = $em->getRepository('loginBundle:Questao'); 
                $arr = $questoesrep->findBy(array('idquizz'=>$idquizz)); 
                $total = count($arr);
                $counter = 1;
                $rightans = 0;
                foreach ($arr as $questao) {
                    $counterstr = strval($counter);
                    $ans = 'answer'.$counterstr;
                    $letter = $request->get($ans);
                    $anstrue = 'answer'.$counterstr.$letter;
                    $answer = $request->get($anstrue);
                    if($answer == $questao->getAnswer())
                    {
                        $rightans++;
                    }
                    $counter++;
                }
                $final = $rightans/$total*100;
                $final = round($final, 2);
                return $this->render('loginBundle:Default:quizzcomplete.html.twig', array('quizz'=>$quizz,'logged'=>'logged','total'=>$total,'final'=>$final,'acertos'=>$rightans)); 
            }
            else
            {
                return $this->redirectToRoute('login_eventolista');
            }
            
        }
        else
        {
            return $this->redirectToRoute('login_eventolista');
        }
    }
    
    public function notfoundAction(Request $request)
    {
        if($this->isLogged($request))
        {
            return $this->render('loginBundle:Default:pagina404.html.twig', array('logged'=>'logged'));  
        }
        else
        {
            return $this->render('loginBundle:Default:pagina404.html.twig', array('logged'=>'notlogged'));  
        }
    }
    
    public function aboutAction(Request $request)
    {
        if($this->isLogged($request))
        {
            return $this->render('loginBundle:Default:about.html.twig', array('logged'=>'logged'));  
        }
        else
        {
            return $this->render('loginBundle:Default:about.html.twig', array('logged'=>'notlogged'));  
        }
    }
    
     
}


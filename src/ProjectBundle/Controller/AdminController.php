<?php

namespace ProjectBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use ProjectBundle\Entity\Article;
use ProjectBundle\Entity\promFixture;
use ProjectBundle\Entity\streetFixture;
use ProjectBundle\Entity\fitoFixture;
use ProjectBundle\Entity\officeFixture;
use ProjectBundle\Entity\azsFixture;
use ProjectBundle\Entity\torgFixture;
use ProjectBundle\Entity\projectFixture;
use ProjectBundle\Entity\ASD;
/**
 * Description of AdminController
 *
 * @author artur
 */
class AdminController extends Controller {

    /**
     * @Route("/admin/", name="adminpage")
     */
    public function indexAction(Request $request) {
        $user = $this->getUser();
        return $this->render('ProjectBundle:Admin:index.html.twig', array(''
                    . 'user' => $user));
    }

    /**
     * @Route("/admin/users", name="users")
     */
    public function listUsersAction() {
        $userManager = $this->get('fos_user.user_manager');
        $user = $this->getUser();
        $users = $userManager->findUsers();
        return $this->render('ProjectBundle:Admin:users.html.twig', array(''
                    . 'users' => $users));
    }

    /**
     * @Route("/admin/registration", name="registration")
     */
    public function registerAction(Request $request) {
        /** @var $formFactory \FOS\UserBundle\Form\Factory\FactoryInterface */
        $formFactory = $this->get('fos_user.registration.form.factory');
        /** @var $userManager \FOS\UserBundle\Model\UserManagerInterface */
        $userManager = $this->get('fos_user.user_manager');
        $user = $userManager->createUser();
        $user->setEnabled(true);
        $user->addRole('ROLE_ADMIN');

        $form = $formFactory->createForm();
        $form->setData($user);


        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                $userManager->updateUser($user);
                $msg = "Пользователь был успешно создан";
                return $this->render('ProjectBundle:Admin:register.html.twig', array(''
                            . 'message' => $msg));
            }
        }

        return $this->render('ProjectBundle:Admin:register.html.twig', array(''
                    . 'form' => $form->createView()));
    }

    /**
     * @Route("/admin/users/edit/{id}", name ="edit")
     */
    public function editAction(Request $request, $id) {
        $userManager = $this->get('fos_user.user_manager');
        $user = $userManager->findUserBy(array('id' => $id));
        $current_logged_in = $this->getUser();
        if ($user->hasRole('ROLE_SUPER_ADMIN')) {
            $error = "У вас нет прав сделать это";
            return $this->render('ProjectBundle:Admin:error.html.twig', array(''
                        . 'error' => $error));
        }
        if (!$user) {
            $error = "Пользователь не найден";
            return $this->render('ProjectBundle:Admin:error.html.twig', array(''
                        . 'error' => $error));
        }
        $form = $this->createFormBuilder($user)
                ->add('username', 'text', array('label' => 'Имя пользователя'))
                ->add('email', 'email', array('label' => 'Электронный адрес'))
                ->add('submit', 'submit', array('label' => 'Сохранить'))
                ->getForm();
        $form->setData($user);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                $userManager->updateUser($user);
                ;
                return $this->redirectToRoute('adminpage');
            }
        }
        return $this->render('ProjectBundle:Admin:edit.html.twig', array(
                    'form' => $form->createView(),
                    'id' => $id));
    }

    /**
     * @Route("/admin/delete/{username}", name="delete")
     */
    public function deleteAction($username) {
        $userManager = $this->get('fos_user.user_manager');
        $current_logged_in = $this->getUser();

        $user = $userManager->findUserByUsername($username);
        if (!$user) {
            $error = "Пользователь не найден";
            return $this->render('ProjectBundle:Admin:error.html.twig', array(''
                        . 'error' => $error));
        }
        if ($user->hasRole('ROLE_SUPER_ADMIN')) {
            $error = "У вас нет прав сделать это";
            return $this->render('ProjectBundle:Admin:error.html.twig', array(''
                        . 'error' => $error));
        }

        if ($user == $current_logged_in) {
            $error = "Вы не можете удалить самого себя";
            return $this->render('ProjectBundle:Admin:error.html.twig', array(''
                        . 'error' => $error));
        } else
            $user = $userManager->deleteUser($user);
        return $this->redirectToRoute('adminpage');
    }

    /**
     * @Route("/admin/addarticle", name="addarticle")
     */
    public function addArticleAction(Request $request) {
        $userManager = $this->get('fos_user.user_manager');
        $article = new Article();
        $article->setCreatedAt(new \DateTime('now'));

        $form = $this->createFormBuilder($article)
                ->add('name', 'text', array('label' => 'Имя статьи'))
                ->add('fText', 'textarea', array('label' => 'Текст статьи'))
                ->add('picture', 'text', array('label' => 'URL картинки'))
                ->add('submit', 'submit', array('label' => 'Добавить'))
                ->getForm();
        $form->setData($article);


        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($article);
                $em->flush();
                $msg = "Статья была успешно добавлена";
                return $this->render('ProjectBundle:Admin:createarticle.html.twig', array(''
                            . 'message' => $msg));
            }
        }

        return $this->render('ProjectBundle:Admin:createarticle.html.twig', array(''
                    . 'form' => $form->createView()));
    }

    /**
     * @Route("/admin/articles", name="listarticles")
     */
    public function listArticlesAction() {

        $articles = $this->getDoctrine()->getRepository('ProjectBundle:Article')
                ->findAll();
        return $this->render('ProjectBundle:Admin:articles.html.twig', array(''
                    . 'article' => $articles));
    }

    /**
     * @Route("/admin/articleedit/{id}", name="editarticle")
     */
    public function editArticleAction($id, Request $request) {

        $current_logged_in = $this->getUser();
        $articles_found = $this->getDoctrine()->getRepository("ProjectBundle:Article")
                ->findOneBy(array('id' => $id));
        if (!$articles_found) {
            $error = "Новость не найдена";
            return $this->render("ProjectBundle:Admin:error.html.twig", array(''
                        . 'error' => $error));
        }
        $form = $this->createFormBuilder($articles_found)
                ->add('name', 'text', array('label' => 'Заголовок'))
                ->add('fText', 'textarea', array('label' => 'Текст новости'))
                ->add('picture', 'text', array('label' => 'Картинка новости'))
                ->add('submit', 'submit', array('label' => 'Сохранить'))
                ->getForm();
        $form->setData($articles_found);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                $articles_found->setCreatedAt($articles_found->getCreatedAt());
                $em = $this->getDoctrine()->getManager();
                $em->persist($articles_found);
                $em->flush();
                $msg = "Статья была обновлена!";
                $url = "/info/$id";

                return $this->redirect($url);
            }
        }

        return $this->render('ProjectBundle:Admin:articleedit.html.twig', array(''
                    . 'form' => $form->createView(), ''
                    . 'id' => $id));
    }

    /**
     * @Route("/admin/deletearticle/{id}", name="delarticle")
     */
    public function deleteArticleAction($id) {
        $article_found = $this->getDoctrine()->getRepository('ProjectBundle:Article')
                ->findOneBy(array('id' => $id));
        if (!$article_found) {
            $error = "Статья не найдена";
            return $this->render('ProjectBundle:Admin:error.html.twig', array(''
                        . 'error' => $error));
        }
        $em = $this->getDoctrine()->getManager();
        $em->remove($article_found);
        $em->flush();
        return $this->redirectToRoute('info');
    }

    /**
     * @Route("/admin/createproduct/", name="createproduct")
     */
    public function createProductAction() {
        return $this->render('ProjectBundle:Admin:createproduct.html.twig');
    }

    /**
     * @Route("/admin/createproduct/promfixture", name="createpromfixture")
     */
    public function createpromFixtureAction(Request $request) {
        $userManager = $this->get('fos_user.user_manager');
        $fixture = new promFixture();
        $fixture->setCreatedAt(new \DateTime('now'));
        $fixture->setType('pr');

        $form = $this->createFormBuilder($fixture)
                ->add('name', 'text', array('label' => 'Имя светильника'))
                ->add('power', 'number', array('label' => 'Мощность(вт)'))
                ->add('lightflow', 'number', array('label' => 'Световой поток(лм)'))
                ->add('degreeprotection', 'number', array('label' => 'Степень защиты(ip)'))
                ->add('shortDesc', 'textarea', array('label' => 'Короткое описание'))
                ->add('fullDesc', 'textarea', array('label' => 'Полное описание'))
                ->add('picture', 'textarea', array('label' => 'Картинка(URL)'))
                ->add('appointmentTwo', 'text', array('label' => 'Назначение два'))
                ->add('sumsvetpotok', 'text', array('label' => 'Суммарный световой поток с учетом потерь,Лм'))
                ->add('koefpulsatsiy', 'text', array('label' => 'Коэффициент пульсаций светового потока, %'))
                ->add('markasvetodioda', 'text', array('label' => 'Марка светодиода O'))
                ->add('kolvosvetodiodov', 'text', array('label' => 'Количество светодиодов, Шт'))
                ->add('previshenievihnapryaz', 'text', array('label' => 'Превышение выходного напряжения'))
                ->add('napryazeniepitaniya', 'text', array('label' => 'Напряжение питания, В'))
                ->add('rabresurssvetodiodov', 'text', array('label' => 'Рабочий ресурс светодиодов, Ч'))
                ->add('rabtoksvetodiodov', 'text', array('label' => 'Рабочий ток светодиодов, мА'))
                ->add('svetpotokodnogo', 'text', array('label' => 'Световой поток одного светодиода, Лм'))
                ->add('kriviesilisveta', 'text', array('label' => 'Кривые силы света (КСС) Д'))
                ->add('tsvetovayatemp', 'text', array('label' => 'Цветовая температура, К'))
                ->add('indextsvetoperedachi', 'text', array('label' => 'Индекс цветопередачи'))
                ->add('vremyavklucheniya', 'text', array('label' => 'Время включения светильника, С '))
                ->add('materialrasseivatelya', 'text', array('label' => 'Материал рассеивателя '))
                ->add('kolvoistochnikov', 'text', array('label' => 'Количество источников питания'))
                ->add('materialmontajnihplat', 'text', array('label' => 'Материал монтажных плат '))
                ->add('materialkorpusa', 'text', array('label' => 'Материал корпуса'))
                ->add('sposopkrepleniya', 'text', array('label' => 'Способ крепления светильника '))
                ->add('klasszashitiottoka', 'text', array('label' => 'Класс защиты от поражения электрическим током '))
                ->add('temperaturaekspluataciy', 'text', array('label' => 'Температура эксплуатации, °С '))
                ->add('garantiya', 'text', array('label' => 'Гарантия, мес'))
                ->add('proizvoditelistochnikapitaniya', 'text', array('label' => 'Производитель источника питания '))
                ->add('model', 'text', array('label' => 'Модель'))
                ->add('grozozashita', 'text', array('label' => 'Грозозащита'))
                ->add('termozashita', 'text', array('label' => 'Термозащита'))
                ->add('zashitaot380', 'text', array('label' => 'Защита от 380, В'))
                ->add('zashitaotKorotkogozamika', 'text', array('label' => 'Защита от короткого замыкания'))
                ->add('ZashitaOtholostogoHoda', 'text', array('label' => 'Защита от холостого хода'))
                ->add('zashitaOtPerenapryajeniya', 'text', array('label' => 'Защита от перенапряжения'))
                ->add('chastota', 'text', array('label' => 'Частота, Гц '))
                ->add('koefpower', 'text', array('label' => 'Коэффициент мощности ИП,'))
                ->add('stepenzahistiIstochnikapitaniya', 'text', array('label' => 'Степень защиты источника питания, IP'))
                ->add('elektromagnitnayasovmest', 'text', array('label' => 'Электромагнитная совместимость (радиопомехи) по ГОСТ,'))
                ->add('galvanicheskIzol', 'text', array('label' => 'Гальваническая изоляция'))
                ->add('probivnoeNapryajenie', 'text', array('label' => 'Пробивное напряжение , кВ'))
                ->add('soprotivlenieIzolatsii', 'text', array('label' => 'Сопротивление изоляции, Мом '))
                ->add('gabariti', 'text', array('label' => 'Габаритные размеры светильника ( ДхШхВ), мм'))
                ->add('massanetto', 'text', array('label' => 'Масса нетто, Кг'))
                ->add('kolvovKorobke', 'text', array('label' => 'Количество светильников в коробке, шт'))
                ->add('gabaritiKorobki', 'text', array('label' => 'Габариты коробки, ( ДхШхВ), мм '))
                ->add('obiomkorobki', 'text', array('label' => 'Объем коробки, м3'))
                ->add('massaBrutto', 'text', array('label' => 'Масса брутто, Кг '))
                ->add('vidKlimatichispol', 'text', array('label' => 'Вид климатического исполнения'))
                ->add('klassopasnosti', 'text', array('label' => 'Класс опасности утилизации отходов'))
                ->add('indexEnergoeffect', 'text', array('label' => 'Индекс энергоэффективности (EEI) '))
                ->add('ploshadTeplootvodPoverhn', 'text', array('label' => 'Площадь теплоотводящей поверхности, Мм2'))
                ->add('teplovidelenie', 'text', array('label' => 'Тепловыделение (BTU) '))
                ->add('submit', 'submit', array('label' => 'Добавить'))
                ->getForm();
        $form->setData($fixture);


        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($fixture);
                $em->flush();
                $msg = "Товар был успешно добавлен";
                return $this->render('ProjectBundle:Admin:createpromfixture.html.twig', array(''
                            . 'message' => $msg));
            }
        }

        return $this->render('ProjectBundle:Admin:createpromfixture.html.twig', array(''
                    . 'form' => $form->createView()));
    }

	
    /**
     * @Route("/admin/createproduct/officefixture", name="createofficefixture")
     */
    public function createofficeFixtureAction(Request $request) {
        $userManager = $this->get('fos_user.user_manager');
        $fixture = new officeFixture();
        $fixture->setCreatedAt(new \DateTime('now'));
        $fixture->setType('off');
        $form = $this->createFormBuilder($fixture)
                ->add('name', 'text', array('label' => 'Имя светильника'))
                ->add('power', 'number', array('label' => 'Мощность(вт)'))
                ->add('lightflow', 'number', array('label' => 'Световой поток(лм)'))
                ->add('degreeprotection', 'number', array('label' => 'Степень защиты(ip)'))
                ->add('shortDesc', 'textarea', array('label' => 'Короткое описание'))
                ->add('fullDesc', 'textarea', array('label' => 'Полное описание'))
                ->add('picture', 'textarea', array('label' => 'Картинка(URL)'))
                ->add('appointmentTwo', 'text', array('label' => 'Назначение два'))
                ->add('sumsvetpotok', 'text', array('label' => 'Суммарный световой поток с учетом потерь,Лм'))
                ->add('koefpulsatsiy', 'text', array('label' => 'Коэффициент пульсаций светового потока, %'))
                ->add('markasvetodioda', 'text', array('label' => 'Марка светодиода O'))
                ->add('kolvosvetodiodov', 'text', array('label' => 'Количество светодиодов, Шт'))
                ->add('rabresurssvetodiodov', 'text', array('label' => 'Рабочий ресурс светодиодов, Ч'))
                ->add('previshenievihnapryaz', 'text', array('label' => 'Превышение выходного напряжения'))
                ->add('napryazeniepitaniya', 'text', array('label' => 'Напряжение питания, В'))
                ->add('rabtoksvetodiodov', 'text', array('label' => 'Рабочий ток светодиодов, мА'))
                ->add('svetpotokodnogo', 'text', array('label' => 'Световой поток одного светодиода, Лм'))
                ->add('kriviesilisveta', 'text', array('label' => 'Кривые силы света (КСС) Д'))
                ->add('tsvetovayatemp', 'text', array('label' => 'Цветовая температура, К'))
                ->add('indextsvetoperedachi', 'text', array('label' => 'Индекс цветопередачи'))
                ->add('vremyavklucheniya', 'text', array('label' => 'Время включения светильника, С '))
                ->add('materialrasseivatelya', 'text', array('label' => 'Материал рассеивателя '))
                ->add('kolvoistochnikov', 'text', array('label' => 'Количество источников питания'))
                ->add('materialmontajnihplat', 'text', array('label' => 'Материал монтажных плат '))
                ->add('materialkorpusa', 'text', array('label' => 'Материал корпуса'))
                ->add('sposopkrepleniya', 'text', array('label' => 'Способ крепления светильника '))
                ->add('klasszashitiottoka', 'text', array('label' => 'Класс защиты от поражения электрическим током '))
                ->add('temperaturaekspluataciy', 'text', array('label' => 'Температура эксплуатации, °С '))
                ->add('garantiya', 'text', array('label' => 'Гарантия, мес'))
                ->add('proizvoditelistochnikapitaniya', 'text', array('label' => 'Производитель источника питания '))
                ->add('model', 'text', array('label' => 'Модель'))
                ->add('grozozashita', 'text', array('label' => 'Грозозащита'))
                ->add('termozashita', 'text', array('label' => 'Термозащита'))
                ->add('zashitaot380', 'text', array('label' => 'Защита от 380, В'))
                ->add('zashitaotKorotkogozamika', 'text', array('label' => 'Защита от короткого замыкания'))
                ->add('ZashitaOtholostogoHoda', 'text', array('label' => 'Защита от холостого хода'))
                ->add('zashitaOtPerenapryajeniya', 'text', array('label' => 'Защита от перенапряжения'))
                ->add('chastota', 'text', array('label' => 'Частота, Гц '))
                ->add('koefpower', 'text', array('label' => 'Коэффициент мощности ИП,'))
                ->add('stepenzahistiIstochnikapitaniya', 'text', array('label' => 'Степень защиты источника питания, IP'))
                ->add('elektromagnitnayasovmest', 'text', array('label' => 'Электромагнитная совместимость (радиопомехи) по ГОСТ,'))
                ->add('galvanicheskIzol', 'text', array('label' => 'Гальваническая изоляция'))
                ->add('probivnoeNapryajenie', 'text', array('label' => 'Пробивное напряжение , кВ'))
                ->add('soprotivlenieIzolatsii', 'text', array('label' => 'Сопротивление изоляции, Мом '))
                ->add('gabariti', 'text', array('label' => 'Габаритные размеры светильника ( ДхШхВ), мм'))
                ->add('massanetto', 'text', array('label' => 'Масса нетто, Кг'))
                ->add('kolvovKorobke', 'text', array('label' => 'Количество светильников в коробке, шт'))
                ->add('gabaritiKorobki', 'text', array('label' => 'Габариты коробки, ( ДхШхВ), мм '))
                ->add('obiomkorobki', 'text', array('label' => 'Объем коробки, м3'))
                ->add('massaBrutto', 'text', array('label' => 'Масса брутто, Кг '))
                ->add('vidKlimatichispol', 'text', array('label' => 'Вид климатического исполнения'))
                ->add('submit', 'submit', array('label' => 'Добавить'))
                ->getForm();
        $form->setData($fixture);


        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($fixture);
                $em->flush();
                $msg = "Товар был успешно добавлен";
                return $this->render('ProjectBundle:Admin:createofficefixture.html.twig', array(''
                            . 'message' => $msg));
            }
        }

        return $this->render('ProjectBundle:Admin:createofficefixture.html.twig', array(''
                    . 'form' => $form->createView()));
    }

    /**
     * @Route("/admin/createproduct/torgfixture", name="createtorgfixture")
     */
    public function createtorgFixtureAction(Request $request) {
        $userManager = $this->get('fos_user.user_manager');
        $fixture = new torgFixture();
        $fixture->setCreatedAt(new \DateTime('now'));
        $fixture->setType('tor');

        $form = $this->createFormBuilder($fixture)
                ->add('name', 'text', array('label' => 'Имя светильника'))
                ->add('power', 'number', array('label' => 'Мощность(вт)'))
                ->add('lightflow', 'number', array('label' => 'Световой поток(лм)'))
                ->add('degreeprotection', 'number', array('label' => 'Степень защиты(ip)'))
                ->add('shortDesc', 'textarea', array('label' => 'Короткое описание'))
                ->add('fullDesc', 'textarea', array('label' => 'Полное описание'))
                ->add('picture', 'textarea', array('label' => 'Картинка(URL)'))
                ->add('appointmentTwo', 'text', array('label' => 'Назначение два'))
                ->add('sumsvetpotok', 'text', array('label' => 'Суммарный световой поток с учетом потерь,Лм'))
                ->add('koefpulsatsiy', 'text', array('label' => 'Коэффициент пульсаций светового потока, %'))
                ->add('markasvetodioda', 'text', array('label' => 'Марка светодиода O'))
                ->add('kolvosvetodiodov', 'text', array('label' => 'Количество светодиодов, Шт'))
                ->add('rabresurssvetodiodov', 'text', array('label' => 'Рабочий ресурс светодиодов, Ч'))
                ->add('rabtoksvetodiodov', 'text', array('label' => 'Рабочий ток светодиодов, мА'))
                ->add('svetpotokodnogo', 'text', array('label' => 'Световой поток одного светодиода, Лм'))
                ->add('kriviesilisveta', 'text', array('label' => 'Кривые силы света (КСС) Д'))
                ->add('tsvetovayatemp', 'text', array('label' => 'Цветовая температура, К'))
                ->add('indextsvetoperedachi', 'text', array('label' => 'Индекс цветопередачи'))
                ->add('vremyavklucheniya', 'text', array('label' => 'Время включения светильника, С '))
                ->add('materialrasseivatelya', 'text', array('label' => 'Материал рассеивателя '))
                ->add('kolvoistochnikov', 'text', array('label' => 'Количество источников питания'))
                ->add('materialmontajnihplat', 'text', array('label' => 'Материал монтажных плат '))
                ->add('materialkorpusa', 'text', array('label' => 'Материал корпуса'))
                ->add('sposopkrepleniya', 'text', array('label' => 'Способ крепления светильника '))
                ->add('klasszashitiottoka', 'text', array('label' => 'Класс защиты от поражения электрическим током '))
                ->add('temperaturaekspluataciy', 'text', array('label' => 'Температура эксплуатации, °С '))
                ->add('garantiya', 'text', array('label' => 'Гарантия, мес'))
                ->add('proizvoditelistochnikapitaniya', 'text', array('label' => 'Производитель источника питания '))
                ->add('model', 'text', array('label' => 'Модель'))
                ->add('grozozashita', 'text', array('label' => 'Грозозащита'))
                ->add('termozashita', 'text', array('label' => 'Термозащита'))
                ->add('zashitaot380', 'text', array('label' => 'Защита от 380, В'))
                ->add('zashitaotKorotkogozamika', 'text', array('label' => 'Защита от короткого замыкания'))
                ->add('ZashitaOtholostogoHoda', 'text', array('label' => 'Защита от холостого хода'))
                ->add('chastota', 'text', array('label' => 'Частота, Гц '))
                ->add('preddiapazonvhodnih', 'text', array('label' => 'Предельный диапазон входных напряжений'))
                ->add('previshenievihnapryaz', 'text', array('label' => 'Превышение выходного напряжения'))
                ->add('napryazeniepitaniya', 'text', array('label' => 'Напряжение питания, В'))
                ->add('koefpower', 'text', array('label' => 'Коэффициент мощности ИП,'))
                ->add('stepenzahistiIstochnikapitaniya', 'text', array('label' => 'Степень защиты источника питания, IP'))
                ->add('elektromagnitnayasovmest', 'text', array('label' => 'Электромагнитная совместимость (радиопомехи) по ГОСТ,'))
                ->add('galvanicheskIzol', 'text', array('label' => 'Гальваническая изоляция'))
                ->add('probivnoeNapryajenie', 'text', array('label' => 'Пробивное напряжение , кВ'))
                ->add('soprotivlenieIzolatsii', 'text', array('label' => 'Сопротивление изоляции, Мом '))
                ->add('gabariti', 'text', array('label' => 'Габаритные размеры светильника ( ДхШхВ), мм'))
                ->add('massanetto', 'text', array('label' => 'Масса нетто, Кг'))
                ->add('kolvovKorobke', 'text', array('label' => 'Количество светильников в коробке, шт'))
                ->add('gabaritiKorobki', 'text', array('label' => 'Габариты коробки, ( ДхШхВ), мм '))
                ->add('obiomkorobki', 'text', array('label' => 'Объем коробки, м3'))
                ->add('massaBrutto', 'text', array('label' => 'Масса брутто, Кг '))
                ->add('vidKlimatichispol', 'text', array('label' => 'Вид климатического исполнения'))
                ->add('klassopasnosti', 'text', array('label' => 'Класс опасности утилизации отходов'))
                ->add('indexEnergoeffect', 'text', array('label' => 'Индекс энергоэффективности (EEI) '))
                ->add('ploshadTeplootvodPoverhn', 'text', array('label' => 'Площадь теплоотводящей поверхности, Мм2'))
                ->add('teplovidelenie', 'text', array('label' => 'Тепловыделение (BTU) '))
                ->add('submit', 'submit', array('label' => 'Добавить'))
                ->getForm();
        $form->setData($fixture);


        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($fixture);
                $em->flush();
                $msg = "Товар был успешно добавлен";
                return $this->render('ProjectBundle:Admin:createtorgfixture.html.twig', array(''
                            . 'message' => $msg));
            }
        }

        return $this->render('ProjectBundle:Admin:createtorgfixture.html.twig', array(''
                    . 'form' => $form->createView()));
    }

    /**
     * @Route("/admin/createproduct/streetfixture", name="createstreetfixture")
     */
    public function createstreetFixtureAction(Request $request) {
        $userManager = $this->get('fos_user.user_manager');
        $fixture = new streetFixture();
        $fixture->setCreatedAt(new \DateTime('now'));
        $fixture->setType('str');

        $form = $this->createFormBuilder($fixture)
                ->add('name', 'text', array('label' => 'Имя светильника'))
                ->add('power', 'number', array('label' => 'Мощность(вт)'))
                ->add('lightflow', 'number', array('label' => 'Световой поток(лм)'))
                ->add('degreeprotection', 'number', array('label' => 'Степень защиты(ip)'))
                ->add('shortDesc', 'textarea', array('label' => 'Короткое описание'))
                ->add('fullDesc', 'textarea', array('label' => 'Полное описание'))
                ->add('picture', 'textarea', array('label' => 'Картинка(URL)'))
                ->add('appointmentTwo', 'text', array('label' => 'Назначение два'))
                ->add('sumsvetpotok', 'text', array('label' => 'Суммарный световой поток с учетом потерь,Лм'))
                ->add('koefpulsatsiy', 'text', array('label' => 'Коэффициент пульсаций светового потока, %'))
                ->add('markasvetodioda', 'text', array('label' => 'Марка светодиода O'))
                ->add('kolvosvetodiodov', 'text', array('label' => 'Количество светодиодов, Шт'))
                ->add('rabresurssvetodiodov', 'text', array('label' => 'Рабочий ресурс светодиодов, Ч'))
                ->add('rabtoksvetodiodov', 'text', array('label' => 'Рабочий ток светодиодов, мА'))
                ->add('svetpotokodnogo', 'text', array('label' => 'Световой поток одного светодиода, Лм'))
                ->add('kriviesilisveta', 'text', array('label' => 'Кривые силы света (КСС) Д'))
                ->add('tsvetovayatemp', 'text', array('label' => 'Цветовая температура, К'))
                ->add('indextsvetoperedachi', 'text', array('label' => 'Индекс цветопередачи'))
                ->add('vremyavklucheniya', 'text', array('label' => 'Время включения светильника, С '))
                ->add('materialrasseivatelya', 'text', array('label' => 'Материал рассеивателя '))
                ->add('kolvoistochnikov', 'text', array('label' => 'Количество источников питания'))
                ->add('materialmontajnihplat', 'text', array('label' => 'Материал монтажных плат '))
                ->add('materialkorpusa', 'text', array('label' => 'Материал корпуса'))
                ->add('sposopkrepleniya', 'text', array('label' => 'Способ крепления светильника '))
                ->add('klasszashitiottoka', 'text', array('label' => 'Класс защиты от поражения электрическим током '))
                ->add('temperaturaekspluataciy', 'text', array('label' => 'Температура эксплуатации, °С '))
                ->add('garantiya', 'text', array('label' => 'Гарантия, мес'))
                ->add('previshenievihnapryaz', 'text', array('label' => 'Превышение выходного напряжения'))
                ->add('napryazeniepitaniya', 'text', array('label' => 'Напряжение питания, В'))
                ->add('proizvoditelistochnikapitaniya', 'text', array('label' => 'Производитель источника питания '))
                ->add('model', 'text', array('label' => 'Модель'))
                ->add('grozozashita', 'text', array('label' => 'Грозозащита'))
                ->add('termozashita', 'text', array('label' => 'Термозащита'))
                ->add('zashitaot380', 'text', array('label' => 'Защита от 380, В'))
                ->add('zashitaotKorotkogozamika', 'text', array('label' => 'Защита от короткого замыкания'))
                ->add('ZashitaOtholostogoHoda', 'text', array('label' => 'Защита от холостого хода'))
                ->add('zashitaOtPerenapryajeniya', 'text', array('label' => 'Защита от перенапряжения'))
                ->add('chastota', 'text', array('label' => 'Частота, Гц '))
                ->add('koefpower', 'text', array('label' => 'Коэффициент мощности ИП,'))
                ->add('stepenzahistiIstochnikapitaniya', 'text', array('label' => 'Степень защиты источника питания, IP'))
                ->add('elektromagnitnayasovmest', 'text', array('label' => 'Электромагнитная совместимость (радиопомехи) по ГОСТ,'))
                ->add('galvanicheskIzol', 'text', array('label' => 'Гальваническая изоляция'))
                ->add('probivnoeNapryajenie', 'text', array('label' => 'Пробивное напряжение , кВ'))
                ->add('soprotivlenieIzolatsii', 'text', array('label' => 'Сопротивление изоляции, Мом '))
                ->add('gabariti', 'text', array('label' => 'Габаритные размеры светильника ( ДхШхВ), мм'))
                ->add('massanetto', 'text', array('label' => 'Масса нетто, Кг'))
                ->add('kolvovKorobke', 'text', array('label' => 'Количество светильников в коробке, шт'))
                ->add('gabaritiKorobki', 'text', array('label' => 'Габариты коробки, ( ДхШхВ), мм '))
                ->add('obiomkorobki', 'text', array('label' => 'Объем коробки, м3'))
                ->add('massaBrutto', 'text', array('label' => 'Масса брутто, Кг '))
                ->add('vidKlimatichispol', 'text', array('label' => 'Вид климатического исполнения'))
                ->add('klassopasnosti', 'text', array('label' => 'Класс опасности утилизации отходов'))
                ->add('indexEnergoeffect', 'text', array('label' => 'Индекс энергоэффективности (EEI) '))
                ->add('ploshadTeplootvodPoverhn', 'text', array('label' => 'Площадь теплоотводящей поверхности, Мм2'))
                ->add('teplovidelenie', 'text', array('label' => 'Тепловыделение (BTU) '))
                ->add('vnutrdiametrconsoli', 'text', array('label' => 'Внутренний диаметр консоли, мм'))
                ->add('submit', 'submit', array('label' => 'Добавить'))
                ->getForm();
        $form->setData($fixture);


        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($fixture);
                $em->flush();
                $msg = "Товар был успешно добавлен";
                return $this->render('ProjectBundle:Admin:createstreetfixture.html.twig', array(''
                            . 'message' => $msg));
            }
        }

        return $this->render('ProjectBundle:Admin:createstreetfixture.html.twig', array(''
                    . 'form' => $form->createView()));
    }

    /**
     * @Route("/admin/createproduct/fitofixture", name="createfitofixture")
     */
    public function createfitoFixtureAction(Request $request) {
        $userManager = $this->get('fos_user.user_manager');
        $fixture = new fitoFixture();
        $fixture->setCreatedAt(new \DateTime('now'));
        $fixture->setType('fito');

        $form = $this->createFormBuilder($fixture)
                ->add('name', 'text', array('label' => 'Имя светильника'))
                ->add('power', 'number', array('label' => 'Мощность(вт)'))
                ->add('fotpotok', 'number', array('label' => 'Фотонный поток PAR, мкмоль/с'))
                ->add('degreeprotection', 'number', array('label' => 'Степень защиты(ip)'))
                ->add('shortDesc', 'textarea', array('label' => 'Короткое описание'))
                ->add('fullDesc', 'textarea', array('label' => 'Полное описание'))
                ->add('picture', 'textarea', array('label' => 'Картинка(URL)'))
                ->add('appointmentTwo', 'text', array('label' => 'Назначение два'))
                ->add('proportsiyyspectra', 'text', array('label' => 'Пропорции спектра светильника, %'))
                ->add('koefpulsatsiy', 'text', array('label' => 'Коэффициент пульсаций светового потока, %'))
                ->add('markasvetodioda', 'text', array('label' => 'Марка светодиода O'))
                ->add('kolvosvetodiodov', 'text', array('label' => 'Количество светодиодов, Шт'))
                ->add('rabresurssvetodiodov', 'text', array('label' => 'Рабочий ресурс светодиодов, Ч'))
                ->add('rabtoksvetodiodov', 'text', array('label' => 'Рабочий ток светодиодов, мА'))
                ->add('svetpotokodnogo', 'text', array('label' => 'Световой поток одного светодиода, Лм'))
                ->add('kriviesilisveta', 'text', array('label' => 'Кривые силы света (КСС) Д'))
                ->add('teplovidelenie', 'text', array('label' => 'Тепловыделение (BTU)'))
                ->add('ploshadTeplootvodPoverhn', 'text', array('label' => 'Площадь теплоотводящей поверхности, Mм2'))
                ->add('klassopasnosti', 'text', array('label' => 'Класс опасности утилизации отходов'))
                ->add('materialrasseivatelya', 'text', array('label' => 'Материал рассеивателя '))
                ->add('kolvoistochnikov', 'text', array('label' => 'Количество источников питания'))
                ->add('materialmontajnihplat', 'text', array('label' => 'Материал монтажных плат '))
                ->add('materialkorpusa', 'text', array('label' => 'Материал корпуса'))
                ->add('sposopkrepleniya', 'text', array('label' => 'Способ крепления светильника '))
                ->add('klasszashitiottoka', 'text', array('label' => 'Класс защиты от поражения электрическим током '))
                ->add('temperaturaekspluataciy', 'text', array('label' => 'Температура эксплуатации, °С '))
                ->add('garantiya', 'text', array('label' => 'Гарантия, мес'))
                ->add('proizvoditelistochnikapitaniya', 'text', array('label' => 'Производитель источника питания '))
                ->add('model', 'text', array('label' => 'Модель'))
                ->add('grozozashita', 'text', array('label' => 'Грозозащита'))
                ->add('termozashita', 'text', array('label' => 'Термозащита'))
                ->add('previshenievihnapryaz', 'text', array('label' => 'Превышение выходного напряжения'))
                ->add('napryazeniepitaniya', 'text', array('label' => 'Напряжение питания, В'))
                ->add('zashitaot380', 'text', array('label' => 'Защита от 380, В'))
                ->add('zashitaotKorotkogozamika', 'text', array('label' => 'Защита от короткого замыкания'))
                ->add('ZashitaOtholostogoHoda', 'text', array('label' => 'Защита от холостого хода'))
                ->add('zashitaOtPerenapryajeniya', 'text', array('label' => 'Защита от перенапряжения'))
                ->add('chastota', 'text', array('label' => 'Частота, Гц '))
                ->add('koefpower', 'text', array('label' => 'Коэффициент мощности ИП,'))
                ->add('stepenzahistiIstochnikapitaniya', 'text', array('label' => 'Степень защиты источника питания, IP'))
                ->add('elektromagnitnayasovmest', 'text', array('label' => 'Электромагнитная совместимость (радиопомехи) по ГОСТ,'))
                ->add('galvanicheskIzol', 'text', array('label' => 'Гальваническая изоляция'))
                ->add('probivnoeNapryajenie', 'text', array('label' => 'Пробивное напряжение , кВ'))
                ->add('soprotivlenieIzolatsii', 'text', array('label' => 'Сопротивление изоляции, Мом '))
                ->add('gabariti', 'text', array('label' => 'Габаритные размеры светильника ( ДхШхВ), мм'))
                ->add('massanetto', 'text', array('label' => 'Масса нетто, Кг'))
                ->add('kolvovKorobke', 'text', array('label' => 'Количество светильников в коробке, шт'))
                ->add('gabaritiKorobki', 'text', array('label' => 'Габариты коробки, ( ДхШхВ), мм '))
                ->add('obiomkorobki', 'text', array('label' => 'Объем коробки, м3'))
                ->add('massaBrutto', 'text', array('label' => 'Масса брутто, Кг '))
                ->add('vidKlimatichispol', 'text', array('label' => 'Вид климатического исполнения'))
                ->add('submit', 'submit', array('label' => 'Добавить'))
                ->getForm();
        $form->setData($fixture);


        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($fixture);
                $em->flush();
                $msg = "Товар был успешно добавлен";
                return $this->render('ProjectBundle:Admin:createfitofixture.html.twig', array(''
                            . 'message' => $msg));
            }
        }

        return $this->render('ProjectBundle:Admin:createfitofixture.html.twig', array(''
                    . 'form' => $form->createView()));
    }

    /**
     * @Route("/admin/createproduct/azsfixture", name="createazsfixture")
     */
    public function createazsFixtureAction(Request $request) {
        $userManager = $this->get('fos_user.user_manager');
        $fixture = new azsFixture();
        $fixture->setCreatedAt(new \DateTime('now'));
        $fixture->setType('azs');

        $form = $this->createFormBuilder($fixture)
                ->add('name', 'text', array('label' => 'Имя светильника'))
                ->add('power', 'number', array('label' => 'Мощность(вт)'))
                ->add('lightflow', 'number', array('label' => 'Световой поток(лм)'))
                ->add('degreeprotection', 'number', array('label' => 'Степень защиты(ip)'))
                ->add('shortDesc', 'textarea', array('label' => 'Короткое описание'))
                ->add('fullDesc', 'textarea', array('label' => 'Полное описание'))
                ->add('picture', 'textarea', array('label' => 'Картинка(URL)'))
                ->add('appointmentTwo', 'text', array('label' => 'Назначение два'))
                ->add('sumsvetpotok', 'text', array('label' => 'Суммарный световой поток с учетом потерь,Лм'))
                ->add('koefpulsatsiy', 'text', array('label' => 'Коэффициент пульсаций светового потока, %'))
                ->add('markasvetodioda', 'text', array('label' => 'Марка светодиода O'))
                ->add('kolvosvetodiodov', 'text', array('label' => 'Количество светодиодов, Шт'))
                ->add('rabresurssvetodiodov', 'text', array('label' => 'Рабочий ресурс светодиодов, Ч'))
                ->add('rabtoksvetodiodov', 'text', array('label' => 'Рабочий ток светодиодов, мА'))
                ->add('svetpotokodnogo', 'text', array('label' => 'Световой поток одного светодиода, Лм'))
                ->add('kriviesilisveta', 'text', array('label' => 'Кривые силы света (КСС) Д'))
                ->add('tsvetovayatemp', 'text', array('label' => 'Цветовая температура, К'))
                ->add('indextsvetoperedachi', 'text', array('label' => 'Индекс цветопередачи'))
                ->add('vremyavklucheniya', 'text', array('label' => 'Время включения светильника, С '))
                ->add('materialrasseivatelya', 'text', array('label' => 'Материал рассеивателя '))
                ->add('kolvoistochnikov', 'text', array('label' => 'Количество источников питания'))
                ->add('materialmontajnihplat', 'text', array('label' => 'Материал монтажных плат '))
                ->add('materialkorpusa', 'text', array('label' => 'Материал корпуса'))
                ->add('sposopkrepleniya', 'text', array('label' => 'Способ крепления светильника '))
                ->add('klasszashitiottoka', 'text', array('label' => 'Класс защиты от поражения электрическим током '))
                ->add('temperaturaekspluataciy', 'text', array('label' => 'Температура эксплуатации, °С '))
                ->add('garantiya', 'text', array('label' => 'Гарантия, мес'))
                ->add('proizvoditelistochnikapitaniya', 'text', array('label' => 'Производитель источника питания '))
                ->add('model', 'text', array('label' => 'Модель'))
                ->add('grozozashita', 'text', array('label' => 'Грозозащита'))
                ->add('previshenievihnapryaz', 'text', array('label' => 'Превышение выходного напряжения'))
                ->add('napryazeniepitaniya', 'text', array('label' => 'Напряжение питания, В'))
                ->add('termozashita', 'text', array('label' => 'Термозащита'))
                ->add('zashitaot380', 'text', array('label' => 'Защита от 380, В'))
                ->add('zashitaotKorotkogozamika', 'text', array('label' => 'Защита от короткого замыкания'))
                ->add('ZashitaOtholostogoHoda', 'text', array('label' => 'Защита от холостого хода'))
                ->add('zashitaOtPerenapryajeniya', 'text', array('label' => 'Защита от перенапряжения'))
                ->add('chastota', 'text', array('label' => 'Частота, Гц '))
                ->add('koefpower', 'text', array('label' => 'Коэффициент мощности ИП,'))
                ->add('stepenzahistiIstochnikapitaniya', 'text', array('label' => 'Степень защиты источника питания, IP'))
                ->add('elektromagnitnayasovmest', 'text', array('label' => 'Электромагнитная совместимость (радиопомехи) по ГОСТ,'))
                ->add('galvanicheskIzol', 'text', array('label' => 'Гальваническая изоляция'))
                ->add('probivnoeNapryajenie', 'text', array('label' => 'Пробивное напряжение , кВ'))
                ->add('soprotivlenieIzolatsii', 'text', array('label' => 'Сопротивление изоляции, Мом '))
                ->add('gabariti', 'text', array('label' => 'Габаритные размеры светильника ( ДхШхВ), мм'))
                ->add('massanetto', 'text', array('label' => 'Масса нетто, Кг'))
                ->add('kolvovKorobke', 'text', array('label' => 'Количество светильников в коробке, шт'))
                ->add('gabaritiKorobki', 'text', array('label' => 'Габариты коробки, ( ДхШхВ), мм '))
                ->add('obiomkorobki', 'text', array('label' => 'Объем коробки, м3'))
                ->add('massaBrutto', 'text', array('label' => 'Масса брутто, Кг '))
                ->add('vidKlimatichispol', 'text', array('label' => 'Вид климатического исполнения'))
                ->add('klassopasnosti', 'text', array('label' => 'Класс опасности утилизации отходов'))
                ->add('indexEnergoeffect', 'text', array('label' => 'Индекс энергоэффективности (EEI) '))
                ->add('ploshadTeplootvodPoverhn', 'text', array('label' => 'Площадь теплоотводящей поверхности, Мм2'))
                ->add('teplovidelenie', 'text', array('label' => 'Тепловыделение (BTU) '))
                ->add('submit', 'submit', array('label' => 'Добавить'))
                ->getForm();
        $form->setData($fixture);


        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($fixture);
                $em->flush();
                $msg = "Товар был успешно добавлен";
                return $this->render('ProjectBundle:Admin:createazsfixture.html.twig', array(''
                            . 'message' => $msg));
            }
        }

        return $this->render('ProjectBundle:Admin:createazsfixture.html.twig', array(''
                    . 'form' => $form->createView()));
    }

	/**
     * @Route("/admin/createproduct/projectfixture", name="createprojectfixture")
     */
    public function createprojectFixtureAction(Request $request) {
        $userManager = $this->get('fos_user.user_manager');
        $fixture = new projectFixture();
        $fixture->setCreatedAt(new \DateTime('now'));
        $fixture->setType('project');

        $form = $this->createFormBuilder($fixture)
                ->add('name', 'text', array('label' => 'Имя светильника'))
                ->add('power', 'number', array('label' => 'Мощность(вт)'))
                ->add('lightflow', 'number', array('label' => 'Световой поток(лм)'))
                ->add('degreeprotection', 'number', array('label' => 'Степень защиты(ip)'))
                ->add('shortDesc', 'textarea', array('label' => 'Короткое описание'))
                ->add('fullDesc', 'textarea', array('label' => 'Полное описание'))
                ->add('picture', 'textarea', array('label' => 'Картинка(URL)'))
                ->add('appointmentTwo', 'text', array('label' => 'Назначение два'))
                ->add('sumsvetpotok', 'text', array('label' => 'Суммарный световой поток с учетом потерь,Лм'))
                ->add('koefpulsatsiy', 'text', array('label' => 'Коэффициент пульсаций светового потока, %'))
                ->add('markasvetodioda', 'text', array('label' => 'Марка светодиода O'))
                ->add('kolvosvetodiodov', 'text', array('label' => 'Количество светодиодов, Шт'))
                ->add('rabresurssvetodiodov', 'text', array('label' => 'Рабочий ресурс светодиодов, Ч'))
                ->add('rabtoksvetodiodov', 'text', array('label' => 'Рабочий ток светодиодов, мА'))
                ->add('svetpotokodnogo', 'text', array('label' => 'Световой поток одного светодиода, Лм'))
                ->add('kriviesilisveta', 'text', array('label' => 'Кривые силы света (КСС) Д'))
                ->add('tsvetovayatemp', 'text', array('label' => 'Цветовая температура, К'))
                ->add('indextsvetoperedachi', 'text', array('label' => 'Индекс цветопередачи'))
                ->add('vremyavklucheniya', 'text', array('label' => 'Время включения светильника, С '))
                ->add('materialrasseivatelya', 'text', array('label' => 'Материал рассеивателя '))
                ->add('kolvoistochnikov', 'text', array('label' => 'Количество источников питания'))
                ->add('materialmontajnihplat', 'text', array('label' => 'Материал монтажных плат '))
                ->add('materialkorpusa', 'text', array('label' => 'Материал корпуса'))
                ->add('sposopkrepleniya', 'text', array('label' => 'Способ крепления светильника '))
                ->add('klasszashitiottoka', 'text', array('label' => 'Класс защиты от поражения электрическим током '))
                ->add('temperaturaekspluataciy', 'text', array('label' => 'Температура эксплуатации, °С '))
                ->add('garantiya', 'text', array('label' => 'Гарантия, мес'))
                ->add('proizvoditelistochnikapitaniya', 'text', array('label' => 'Производитель источника питания '))
                ->add('model', 'text', array('label' => 'Модель'))
                ->add('grozozashita', 'text', array('label' => 'Грозозащита'))
                ->add('previshenievihnapryaz', 'text', array('label' => 'Превышение выходного напряжения'))
                ->add('napryazeniepitaniya', 'text', array('label' => 'Напряжение питания, В'))
                ->add('termozashita', 'text', array('label' => 'Термозащита'))
                ->add('zashitaot380', 'text', array('label' => 'Защита от 380, В'))
                ->add('zashitaotKorotkogozamika', 'text', array('label' => 'Защита от короткого замыкания'))
                ->add('ZashitaOtholostogoHoda', 'text', array('label' => 'Защита от холостого хода'))
                ->add('zashitaOtPerenapryajeniya', 'text', array('label' => 'Защита от перенапряжения'))
                ->add('chastota', 'text', array('label' => 'Частота, Гц '))
                ->add('koefpower', 'text', array('label' => 'Коэффициент мощности ИП,'))
                ->add('stepenzahistiIstochnikapitaniya', 'text', array('label' => 'Степень защиты источника питания, IP'))
                ->add('elektromagnitnayasovmest', 'text', array('label' => 'Электромагнитная совместимость (радиопомехи) по ГОСТ,'))
                ->add('galvanicheskIzol', 'text', array('label' => 'Гальваническая изоляция'))
                ->add('probivnoeNapryajenie', 'text', array('label' => 'Пробивное напряжение , кВ'))
                ->add('soprotivlenieIzolatsii', 'text', array('label' => 'Сопротивление изоляции, Мом '))
                ->add('gabariti', 'text', array('label' => 'Габаритные размеры светильника ( ДхШхВ), мм'))
                ->add('massanetto', 'text', array('label' => 'Масса нетто, Кг'))
                ->add('kolvovKorobke', 'text', array('label' => 'Количество светильников в коробке, шт'))
                ->add('gabaritiKorobki', 'text', array('label' => 'Габариты коробки, ( ДхШхВ), мм '))
                ->add('obiomkorobki', 'text', array('label' => 'Объем коробки, м3'))
                ->add('massaBrutto', 'text', array('label' => 'Масса брутто, Кг '))
                ->add('vidKlimatichispol', 'text', array('label' => 'Вид климатического исполнения'))
                ->add('klassopasnosti', 'text', array('label' => 'Класс опасности утилизации отходов'))
                ->add('indexEnergoeffect', 'text', array('label' => 'Индекс энергоэффективности (EEI) '))
                ->add('ploshadTeplootvodPoverhn', 'text', array('label' => 'Площадь теплоотводящей поверхности, Мм2'))
                ->add('teplovidelenie', 'text', array('label' => 'Тепловыделение (BTU) '))
                ->add('submit', 'submit', array('label' => 'Добавить'))
                ->getForm();
        $form->setData($fixture);


        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($fixture);
                $em->flush();
                $msg = "Товар был успешно добавлен";
                return $this->render('ProjectBundle:Admin:createprojectfixture.html.twig', array(''
                            . 'message' => $msg));
            }
        }

        return $this->render('ProjectBundle:Admin:createprojectfixture.html.twig', array(''
                    . 'form' => $form->createView()));
    }
    /**
     * @Route("/admin/products/", name="products")
     */
    public function listProductsAction() {
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
        /* $lamps = $this->getDoctrine()->getRepository('ProjectBundle:Lamp')
          ->findAll(); */
        if (!$promfixtures)/* || !$lamps) */ {
            return $this->redirectToRoute('home');
        }
        return $this->render('ProjectBundle:Admin:products.html.twig', array(''
                    . 'promfixtures' => $promfixtures, ''
                    . 'officefixtures' => $officefixtures, ''
                    . 'torgfixtures' => $torgfixtures, ''
                    . 'streetfixtures' => $streetfixtures, ''
                    . 'fitofixtures' => $fitofixtures, ''
                    . 'azsfixtures' => $azsfixtures));
    }

    /**
     * @Route("/admin/editpfix/{id}", name="editpromFixture")
     */
    public function editpromFixtureAction($id, Request $request) {
        $products = $this->getDoctrine()->getRepository("ProjectBundle:promFixture")
                ->findOneBy(array('id' => $id));
        if (!$products) {
            $error = "Товар не найден";
            return $this->render("ProjectBundle:Admin:error.html.twig", array(''
                        . 'error' => $error));
        }
        $form = $this->createFormBuilder($products)
        ->add('name', 'text', array('label' => 'Имя светильника'))
        ->add('power', 'number', array('label' => 'Мощность(вт)'))
        ->add('lightflow', 'number', array('label' => 'Световой поток(лм)'))
        ->add('degreeprotection', 'number', array('label' => 'Степень защиты(ip)'))
        ->add('shortDesc', 'textarea', array('label' => 'Короткое описание'))
        ->add('fullDesc', 'textarea', array('label' => 'Полное описание'))
        ->add('picture', 'textarea', array('label' => 'Картинка(URL)'))
        ->add('appointmentTwo', 'text', array('label' => 'Назначение два'))
        ->add('sumsvetpotok', 'text', array('label' => 'Суммарный световой поток с учетом потерь,Лм'))
        ->add('koefpulsatsiy', 'text', array('label' => 'Коэффициент пульсаций светового потока, %'))
        ->add('markasvetodioda', 'text', array('label' => 'Марка светодиода O'))
        ->add('kolvosvetodiodov', 'text', array('label' => 'Количество светодиодов, Шт'))
        ->add('previshenievihnapryaz', 'text', array('label' => 'Превышение выходного напряжения'))
        ->add('napryazeniepitaniya', 'text', array('label' => 'Напряжение питания, В'))
        ->add('rabresurssvetodiodov', 'text', array('label' => 'Рабочий ресурс светодиодов, Ч'))
        ->add('rabtoksvetodiodov', 'text', array('label' => 'Рабочий ток светодиодов, мА'))
        ->add('svetpotokodnogo', 'text', array('label' => 'Световой поток одного светодиода, Лм'))
        ->add('kriviesilisveta', 'text', array('label' => 'Кривые силы света (КСС) Д'))
        ->add('tsvetovayatemp', 'text', array('label' => 'Цветовая температура, К'))
        ->add('indextsvetoperedachi', 'text', array('label' => 'Индекс цветопередачи'))
        ->add('vremyavklucheniya', 'text', array('label' => 'Время включения светильника, С '))
        ->add('materialrasseivatelya', 'text', array('label' => 'Материал рассеивателя '))
        ->add('kolvoistochnikov', 'text', array('label' => 'Количество источников питания'))
        ->add('materialmontajnihplat', 'text', array('label' => 'Материал монтажных плат '))
        ->add('materialkorpusa', 'text', array('label' => 'Материал корпуса'))
        ->add('sposopkrepleniya', 'text', array('label' => 'Способ крепления светильника '))
        ->add('klasszashitiottoka', 'text', array('label' => 'Класс защиты от поражения электрическим током '))
        ->add('temperaturaekspluataciy', 'text', array('label' => 'Температура эксплуатации, °С '))
        ->add('garantiya', 'text', array('label' => 'Гарантия, мес'))
        ->add('proizvoditelistochnikapitaniya', 'text', array('label' => 'Производитель источника питания '))
        ->add('model', 'text', array('label' => 'Модель'))
        ->add('grozozashita', 'text', array('label' => 'Грозозащита'))
        ->add('termozashita', 'text', array('label' => 'Термозащита'))
        ->add('zashitaot380', 'text', array('label' => 'Защита от 380, В'))
        ->add('zashitaotKorotkogozamika', 'text', array('label' => 'Защита от короткого замыкания'))
        ->add('ZashitaOtholostogoHoda', 'text', array('label' => 'Защита от холостого хода'))
        ->add('zashitaOtPerenapryajeniya', 'text', array('label' => 'Защита от перенапряжения'))
        ->add('chastota', 'text', array('label' => 'Частота, Гц '))
        ->add('koefpower', 'text', array('label' => 'Коэффициент мощности ИП,'))
        ->add('stepenzahistiIstochnikapitaniya', 'text', array('label' => 'Степень защиты источника питания, IP'))
        ->add('elektromagnitnayasovmest', 'text', array('label' => 'Электромагнитная совместимость (радиопомехи) по ГОСТ,'))
        ->add('galvanicheskIzol', 'text', array('label' => 'Гальваническая изоляция'))
        ->add('probivnoeNapryajenie', 'text', array('label' => 'Пробивное напряжение , кВ'))
        ->add('soprotivlenieIzolatsii', 'text', array('label' => 'Сопротивление изоляции, Мом '))
        ->add('gabariti', 'text', array('label' => 'Габаритные размеры светильника ( ДхШхВ), мм'))
        ->add('massanetto', 'text', array('label' => 'Масса нетто, Кг'))
        ->add('kolvovKorobke', 'text', array('label' => 'Количество светильников в коробке, шт'))
        ->add('gabaritiKorobki', 'text', array('label' => 'Габариты коробки, ( ДхШхВ), мм '))
        ->add('obiomkorobki', 'text', array('label' => 'Объем коробки, м3'))
        ->add('massaBrutto', 'text', array('label' => 'Масса брутто, Кг '))
        ->add('vidKlimatichispol', 'text', array('label' => 'Вид климатического исполнения'))
        ->add('klassopasnosti', 'text', array('label' => 'Класс опасности утилизации отходов'))
        ->add('indexEnergoeffect', 'text', array('label' => 'Индекс энергоэффективности (EEI) '))
        ->add('ploshadTeplootvodPoverhn', 'text', array('label' => 'Площадь теплоотводящей поверхности, Мм2'))
        ->add('teplovidelenie', 'text', array('label' => 'Тепловыделение (BTU) '))
        ->add('submit', 'submit', array('label' => 'Сохранить'))
                ->getForm();
        $form->setData($products);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($products);
                $em->flush();
                $msg = "Товар был успешно обновлён!";
                $url = "/fixtures/prom/$id";

                return $this->redirect($url);
            }
        }

        return $this->render('ProjectBundle:Admin:editpromfixture.html.twig', array(''
                    . 'form' => $form->createView(), ''
                    . 'id' => $id));
    }
    
    /**
     * @Route("/admin/editofix/{id}", name="editofficeFixture")
     */
    public function editofficeFixtureAction($id, Request $request) {
        $products = $this->getDoctrine()->getRepository("ProjectBundle:officeFixture")
                ->findOneBy(array('id' => $id));
        if (!$products) {
            $error = "Товар не найден";
            return $this->render("ProjectBundle:Admin:error.html.twig", array(''
                        . 'error' => $error));
        }
        $form = $this->createFormBuilder($products)
                ->add('name', 'text', array('label' => 'Имя светильника'))
                ->add('power', 'number', array('label' => 'Мощность(вт)'))
                ->add('lightflow', 'number', array('label' => 'Световой поток(лм)'))
                ->add('degreeprotection', 'number', array('label' => 'Степень защиты(ip)'))
                ->add('shortDesc', 'textarea', array('label' => 'Короткое описание'))
                ->add('fullDesc', 'textarea', array('label' => 'Полное описание'))
                ->add('picture', 'textarea', array('label' => 'Картинка(URL)'))
                ->add('appointmentTwo', 'text', array('label' => 'Назначение два'))
                ->add('sumsvetpotok', 'text', array('label' => 'Суммарный световой поток с учетом потерь,Лм'))
                ->add('koefpulsatsiy', 'text', array('label' => 'Коэффициент пульсаций светового потока, %'))
                ->add('markasvetodioda', 'text', array('label' => 'Марка светодиода O'))
                ->add('kolvosvetodiodov', 'text', array('label' => 'Количество светодиодов, Шт'))
                ->add('rabresurssvetodiodov', 'text', array('label' => 'Рабочий ресурс светодиодов, Ч'))
                ->add('previshenievihnapryaz', 'text', array('label' => 'Превышение выходного напряжения'))
                ->add('napryazeniepitaniya', 'text', array('label' => 'Напряжение питания, В'))
                ->add('rabtoksvetodiodov', 'text', array('label' => 'Рабочий ток светодиодов, мА'))
                ->add('svetpotokodnogo', 'text', array('label' => 'Световой поток одного светодиода, Лм'))
                ->add('kriviesilisveta', 'text', array('label' => 'Кривые силы света (КСС) Д'))
                ->add('tsvetovayatemp', 'text', array('label' => 'Цветовая температура, К'))
                ->add('indextsvetoperedachi', 'text', array('label' => 'Индекс цветопередачи'))
                ->add('vremyavklucheniya', 'text', array('label' => 'Время включения светильника, С '))
                ->add('materialrasseivatelya', 'text', array('label' => 'Материал рассеивателя '))
                ->add('kolvoistochnikov', 'text', array('label' => 'Количество источников питания'))
                ->add('materialmontajnihplat', 'text', array('label' => 'Материал монтажных плат '))
                ->add('materialkorpusa', 'text', array('label' => 'Материал корпуса'))
                ->add('sposopkrepleniya', 'text', array('label' => 'Способ крепления светильника '))
                ->add('klasszashitiottoka', 'text', array('label' => 'Класс защиты от поражения электрическим током '))
                ->add('temperaturaekspluataciy', 'text', array('label' => 'Температура эксплуатации, °С '))
                ->add('garantiya', 'text', array('label' => 'Гарантия, мес'))
                ->add('proizvoditelistochnikapitaniya', 'text', array('label' => 'Производитель источника питания '))
                ->add('model', 'text', array('label' => 'Модель'))
                ->add('grozozashita', 'text', array('label' => 'Грозозащита'))
                ->add('termozashita', 'text', array('label' => 'Термозащита'))
                ->add('zashitaot380', 'text', array('label' => 'Защита от 380, В'))
                ->add('zashitaotKorotkogozamika', 'text', array('label' => 'Защита от короткого замыкания'))
                ->add('ZashitaOtholostogoHoda', 'text', array('label' => 'Защита от холостого хода'))
                ->add('zashitaOtPerenapryajeniya', 'text', array('label' => 'Защита от перенапряжения'))
                ->add('chastota', 'text', array('label' => 'Частота, Гц '))
                ->add('koefpower', 'text', array('label' => 'Коэффициент мощности ИП,'))
                ->add('stepenzahistiIstochnikapitaniya', 'text', array('label' => 'Степень защиты источника питания, IP'))
                ->add('elektromagnitnayasovmest', 'text', array('label' => 'Электромагнитная совместимость (радиопомехи) по ГОСТ,'))
                ->add('galvanicheskIzol', 'text', array('label' => 'Гальваническая изоляция'))
                ->add('probivnoeNapryajenie', 'text', array('label' => 'Пробивное напряжение , кВ'))
                ->add('soprotivlenieIzolatsii', 'text', array('label' => 'Сопротивление изоляции, Мом '))
                ->add('gabariti', 'text', array('label' => 'Габаритные размеры светильника ( ДхШхВ), мм'))
                ->add('massanetto', 'text', array('label' => 'Масса нетто, Кг'))
                ->add('kolvovKorobke', 'text', array('label' => 'Количество светильников в коробке, шт'))
                ->add('gabaritiKorobki', 'text', array('label' => 'Габариты коробки, ( ДхШхВ), мм '))
                ->add('obiomkorobki', 'text', array('label' => 'Объем коробки, м3'))
                ->add('massaBrutto', 'text', array('label' => 'Масса брутто, Кг '))
                ->add('vidKlimatichispol', 'text', array('label' => 'Вид климатического исполнения'))
                ->add('submit', 'submit', array('label' => 'Сохранить'))
                ->getForm();
        $form->setData($products);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($products);
                $em->flush();
                $msg = "Товар был успешно обновлён!";
                $url = "/fixtures/office/$id";

                return $this->redirect($url);
            }
        }

        return $this->render('ProjectBundle:Admin:editofficefixture.html.twig', array(''
                    . 'form' => $form->createView(), ''
                    . 'id' => $id));
    }
    
    /**
     * @Route("/admin/edittfix/{id}", name="edittorgFixture")
     */
    public function edittorgFixtureAction($id, Request $request) {
        $products = $this->getDoctrine()->getRepository("ProjectBundle:torgFixture")
                ->findOneBy(array('id' => $id));
        if (!$products) {
            $error = "Товар не найден";
            return $this->render("ProjectBundle:Admin:error.html.twig", array(''
                        . 'error' => $error));
        }
        $form = $this->createFormBuilder($products)
                ->add('name', 'text', array('label' => 'Имя светильника'))
                ->add('power', 'number', array('label' => 'Мощность(вт)'))
                ->add('lightflow', 'number', array('label' => 'Световой поток(лм)'))
                ->add('degreeprotection', 'number', array('label' => 'Степень защиты(ip)'))
                ->add('shortDesc', 'textarea', array('label' => 'Короткое описание'))
                ->add('fullDesc', 'textarea', array('label' => 'Полное описание'))
                ->add('picture', 'textarea', array('label' => 'Картинка(URL)'))
                ->add('appointmentTwo', 'text', array('label' => 'Назначение два'))
                ->add('sumsvetpotok', 'text', array('label' => 'Суммарный световой поток с учетом потерь,Лм'))
                ->add('koefpulsatsiy', 'text', array('label' => 'Коэффициент пульсаций светового потока, %'))
                ->add('markasvetodioda', 'text', array('label' => 'Марка светодиода O'))
                ->add('kolvosvetodiodov', 'text', array('label' => 'Количество светодиодов, Шт'))
                ->add('rabresurssvetodiodov', 'text', array('label' => 'Рабочий ресурс светодиодов, Ч'))
                ->add('rabtoksvetodiodov', 'text', array('label' => 'Рабочий ток светодиодов, мА'))
                ->add('svetpotokodnogo', 'text', array('label' => 'Световой поток одного светодиода, Лм'))
                ->add('kriviesilisveta', 'text', array('label' => 'Кривые силы света (КСС) Д'))
                ->add('tsvetovayatemp', 'text', array('label' => 'Цветовая температура, К'))
                ->add('indextsvetoperedachi', 'text', array('label' => 'Индекс цветопередачи'))
                ->add('vremyavklucheniya', 'text', array('label' => 'Время включения светильника, С '))
                ->add('materialrasseivatelya', 'text', array('label' => 'Материал рассеивателя '))
                ->add('kolvoistochnikov', 'text', array('label' => 'Количество источников питания'))
                ->add('materialmontajnihplat', 'text', array('label' => 'Материал монтажных плат '))
                ->add('materialkorpusa', 'text', array('label' => 'Материал корпуса'))
                ->add('sposopkrepleniya', 'text', array('label' => 'Способ крепления светильника '))
                ->add('klasszashitiottoka', 'text', array('label' => 'Класс защиты от поражения электрическим током '))
                ->add('temperaturaekspluataciy', 'text', array('label' => 'Температура эксплуатации, °С '))
                ->add('garantiya', 'text', array('label' => 'Гарантия, мес'))
                ->add('proizvoditelistochnikapitaniya', 'text', array('label' => 'Производитель источника питания '))
                ->add('model', 'text', array('label' => 'Модель'))
                ->add('grozozashita', 'text', array('label' => 'Грозозащита'))
                ->add('termozashita', 'text', array('label' => 'Термозащита'))
                ->add('zashitaot380', 'text', array('label' => 'Защита от 380, В'))
                ->add('zashitaotKorotkogozamika', 'text', array('label' => 'Защита от короткого замыкания'))
                ->add('ZashitaOtholostogoHoda', 'text', array('label' => 'Защита от холостого хода'))
                ->add('chastota', 'text', array('label' => 'Частота, Гц '))
                ->add('preddiapazonvhodnih', 'text', array('label' => 'Предельный диапазон входных напряжений'))
                ->add('previshenievihnapryaz', 'text', array('label' => 'Превышение выходного напряжения'))
                ->add('napryazeniepitaniya', 'text', array('label' => 'Напряжение питания, В'))
                ->add('koefpower', 'text', array('label' => 'Коэффициент мощности ИП,'))
                ->add('stepenzahistiIstochnikapitaniya', 'text', array('label' => 'Степень защиты источника питания, IP'))
                ->add('elektromagnitnayasovmest', 'text', array('label' => 'Электромагнитная совместимость (радиопомехи) по ГОСТ,'))
                ->add('galvanicheskIzol', 'text', array('label' => 'Гальваническая изоляция'))
                ->add('probivnoeNapryajenie', 'text', array('label' => 'Пробивное напряжение , кВ'))
                ->add('soprotivlenieIzolatsii', 'text', array('label' => 'Сопротивление изоляции, Мом '))
                ->add('gabariti', 'text', array('label' => 'Габаритные размеры светильника ( ДхШхВ), мм'))
                ->add('massanetto', 'text', array('label' => 'Масса нетто, Кг'))
                ->add('kolvovKorobke', 'text', array('label' => 'Количество светильников в коробке, шт'))
                ->add('gabaritiKorobki', 'text', array('label' => 'Габариты коробки, ( ДхШхВ), мм '))
                ->add('obiomkorobki', 'text', array('label' => 'Объем коробки, м3'))
                ->add('massaBrutto', 'text', array('label' => 'Масса брутто, Кг '))
                ->add('vidKlimatichispol', 'text', array('label' => 'Вид климатического исполнения'))
                ->add('klassopasnosti', 'text', array('label' => 'Класс опасности утилизации отходов'))
                ->add('indexEnergoeffect', 'text', array('label' => 'Индекс энергоэффективности (EEI) '))
                ->add('ploshadTeplootvodPoverhn', 'text', array('label' => 'Площадь теплоотводящей поверхности, Мм2'))
                ->add('teplovidelenie', 'text', array('label' => 'Тепловыделение (BTU) '))
                ->add('submit', 'submit', array('label' => 'Добавить'))
                ->getForm();
        $form->setData($products);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($products);
                $em->flush();
                $msg = "Товар был успешно обновлён!";
                $url = "/fixtures/torg/$id";

                return $this->redirect($url);
            }
        }

        return $this->render('ProjectBundle:Admin:edittorgfixture.html.twig', array(''
                    . 'form' => $form->createView(), ''
                    . 'id' => $id));
    }
    
    /**
     * @Route("/admin/editsfix/{id}", name="editstreetFixture")
     */
    public function editstreetFixtureAction($id, Request $request) {
        $products = $this->getDoctrine()->getRepository("ProjectBundle:streetFixture")
                ->findOneBy(array('id' => $id));
        if (!$products) {
            $error = "Товар не найден";
            return $this->render("ProjectBundle:Admin:error.html.twig", array(''
                        . 'error' => $error));
        }
        $form = $this->createFormBuilder($products)
                ->add('name', 'text', array('label' => 'Имя светильника'))
                ->add('power', 'number', array('label' => 'Мощность(вт)'))
                ->add('lightflow', 'number', array('label' => 'Световой поток(лм)'))
                ->add('degreeprotection', 'number', array('label' => 'Степень защиты(ip)'))
                ->add('shortDesc', 'textarea', array('label' => 'Короткое описание'))
                ->add('fullDesc', 'textarea', array('label' => 'Полное описание'))
                ->add('picture', 'textarea', array('label' => 'Картинка(URL)'))
                ->add('appointmentTwo', 'text', array('label' => 'Назначение два'))
                ->add('sumsvetpotok', 'text', array('label' => 'Суммарный световой поток с учетом потерь,Лм'))
                ->add('koefpulsatsiy', 'text', array('label' => 'Коэффициент пульсаций светового потока, %'))
                ->add('markasvetodioda', 'text', array('label' => 'Марка светодиода O'))
                ->add('kolvosvetodiodov', 'text', array('label' => 'Количество светодиодов, Шт'))
                ->add('rabresurssvetodiodov', 'text', array('label' => 'Рабочий ресурс светодиодов, Ч'))
                ->add('rabtoksvetodiodov', 'text', array('label' => 'Рабочий ток светодиодов, мА'))
                ->add('svetpotokodnogo', 'text', array('label' => 'Световой поток одного светодиода, Лм'))
                ->add('kriviesilisveta', 'text', array('label' => 'Кривые силы света (КСС) Д'))
                ->add('tsvetovayatemp', 'text', array('label' => 'Цветовая температура, К'))
                ->add('indextsvetoperedachi', 'text', array('label' => 'Индекс цветопередачи'))
                ->add('vremyavklucheniya', 'text', array('label' => 'Время включения светильника, С '))
                ->add('materialrasseivatelya', 'text', array('label' => 'Материал рассеивателя '))
                ->add('kolvoistochnikov', 'text', array('label' => 'Количество источников питания'))
                ->add('materialmontajnihplat', 'text', array('label' => 'Материал монтажных плат '))
                ->add('materialkorpusa', 'text', array('label' => 'Материал корпуса'))
                ->add('sposopkrepleniya', 'text', array('label' => 'Способ крепления светильника '))
                ->add('klasszashitiottoka', 'text', array('label' => 'Класс защиты от поражения электрическим током '))
                ->add('temperaturaekspluataciy', 'text', array('label' => 'Температура эксплуатации, °С '))
                ->add('garantiya', 'text', array('label' => 'Гарантия, мес'))
                ->add('previshenievihnapryaz', 'text', array('label' => 'Превышение выходного напряжения'))
                ->add('napryazeniepitaniya', 'text', array('label' => 'Напряжение питания, В'))
                ->add('proizvoditelistochnikapitaniya', 'text', array('label' => 'Производитель источника питания '))
                ->add('model', 'text', array('label' => 'Модель'))
                ->add('grozozashita', 'text', array('label' => 'Грозозащита'))
                ->add('termozashita', 'text', array('label' => 'Термозащита'))
                ->add('zashitaot380', 'text', array('label' => 'Защита от 380, В'))
                ->add('zashitaotKorotkogozamika', 'text', array('label' => 'Защита от короткого замыкания'))
                ->add('ZashitaOtholostogoHoda', 'text', array('label' => 'Защита от холостого хода'))
                ->add('zashitaOtPerenapryajeniya', 'text', array('label' => 'Защита от перенапряжения'))
                ->add('chastota', 'text', array('label' => 'Частота, Гц '))
                ->add('koefpower', 'text', array('label' => 'Коэффициент мощности ИП,'))
                ->add('stepenzahistiIstochnikapitaniya', 'text', array('label' => 'Степень защиты источника питания, IP'))
                ->add('elektromagnitnayasovmest', 'text', array('label' => 'Электромагнитная совместимость (радиопомехи) по ГОСТ,'))
                ->add('galvanicheskIzol', 'text', array('label' => 'Гальваническая изоляция'))
                ->add('probivnoeNapryajenie', 'text', array('label' => 'Пробивное напряжение , кВ'))
                ->add('soprotivlenieIzolatsii', 'text', array('label' => 'Сопротивление изоляции, Мом '))
                ->add('gabariti', 'text', array('label' => 'Габаритные размеры светильника ( ДхШхВ), мм'))
                ->add('massanetto', 'text', array('label' => 'Масса нетто, Кг'))
                ->add('kolvovKorobke', 'text', array('label' => 'Количество светильников в коробке, шт'))
                ->add('gabaritiKorobki', 'text', array('label' => 'Габариты коробки, ( ДхШхВ), мм '))
                ->add('obiomkorobki', 'text', array('label' => 'Объем коробки, м3'))
                ->add('massaBrutto', 'text', array('label' => 'Масса брутто, Кг '))
                ->add('vidKlimatichispol', 'text', array('label' => 'Вид климатического исполнения'))
                ->add('klassopasnosti', 'text', array('label' => 'Класс опасности утилизации отходов'))
                ->add('indexEnergoeffect', 'text', array('label' => 'Индекс энергоэффективности (EEI) '))
                ->add('ploshadTeplootvodPoverhn', 'text', array('label' => 'Площадь теплоотводящей поверхности, Мм2'))
                ->add('teplovidelenie', 'text', array('label' => 'Тепловыделение (BTU) '))
                ->add('vnutrdiametrconsoli', 'text', array('label' => 'Внутренний диаметр консоли, мм'))
                ->add('submit', 'submit', array('label' => 'Сохранить'))
                ->getForm();
        $form->setData($products);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($products);
                $em->flush();
                $msg = "Товар был успешно обновлён!";
                $url = "/fixtures/street/$id";

                return $this->redirect($url);
            }
        }

        return $this->render('ProjectBundle:Admin:editstreetfixture.html.twig', array(''
                    . 'form' => $form->createView(), ''
                    . 'id' => $id));
    }
    
    /**
     * @Route("/admin/editffix/{id}", name="editfitoFixture")
     */
    public function editfitoFixtureAction($id, Request $request) {
        $products = $this->getDoctrine()->getRepository("ProjectBundle:fitoFixture")
                ->findOneBy(array('id' => $id));
        if (!$products) {
            $error = "Товар не найден";
            return $this->render("ProjectBundle:Admin:error.html.twig", array(''
                        . 'error' => $error));
        }
        $form = $this->createFormBuilder($products)
                ->add('name', 'text', array('label' => 'Имя светильника'))
                ->add('power', 'number', array('label' => 'Мощность(вт)'))
                ->add('fotpotok', 'number', array('label' => 'Фотонный поток PAR, мкмоль/с'))
                ->add('degreeprotection', 'number', array('label' => 'Степень защиты(ip)'))
                ->add('shortDesc', 'textarea', array('label' => 'Короткое описание'))
                ->add('fullDesc', 'textarea', array('label' => 'Полное описание'))
                ->add('picture', 'textarea', array('label' => 'Картинка(URL)'))
                ->add('appointmentTwo', 'text', array('label' => 'Назначение два'))
                ->add('proportsiyyspectra', 'text', array('label' => 'Пропорции спектра светильника, %'))
                ->add('koefpulsatsiy', 'text', array('label' => 'Коэффициент пульсаций светового потока, %'))
                ->add('markasvetodioda', 'text', array('label' => 'Марка светодиода O'))
                ->add('kolvosvetodiodov', 'text', array('label' => 'Количество светодиодов, Шт'))
                ->add('rabresurssvetodiodov', 'text', array('label' => 'Рабочий ресурс светодиодов, Ч'))
                ->add('rabtoksvetodiodov', 'text', array('label' => 'Рабочий ток светодиодов, мА'))
                ->add('svetpotokodnogo', 'text', array('label' => 'Световой поток одного светодиода, Лм'))
                ->add('kriviesilisveta', 'text', array('label' => 'Кривые силы света (КСС) Д'))
                ->add('teplovidelenie', 'text', array('label' => 'Тепловыделение (BTU)'))
                ->add('ploshadTeplootvodPoverhn', 'text', array('label' => 'Площадь теплоотводящей поверхности, Mм2'))
                ->add('klassopasnosti', 'text', array('label' => 'Класс опасности утилизации отходов'))
                ->add('materialrasseivatelya', 'text', array('label' => 'Материал рассеивателя '))
                ->add('kolvoistochnikov', 'text', array('label' => 'Количество источников питания'))
                ->add('materialmontajnihplat', 'text', array('label' => 'Материал монтажных плат '))
                ->add('materialkorpusa', 'text', array('label' => 'Материал корпуса'))
                ->add('sposopkrepleniya', 'text', array('label' => 'Способ крепления светильника '))
                ->add('klasszashitiottoka', 'text', array('label' => 'Класс защиты от поражения электрическим током '))
                ->add('temperaturaekspluataciy', 'text', array('label' => 'Температура эксплуатации, °С '))
                ->add('garantiya', 'text', array('label' => 'Гарантия, мес'))
                ->add('proizvoditelistochnikapitaniya', 'text', array('label' => 'Производитель источника питания '))
                ->add('model', 'text', array('label' => 'Модель'))
                ->add('grozozashita', 'text', array('label' => 'Грозозащита'))
                ->add('termozashita', 'text', array('label' => 'Термозащита'))
                ->add('previshenievihnapryaz', 'text', array('label' => 'Превышение выходного напряжения'))
                ->add('napryazeniepitaniya', 'text', array('label' => 'Напряжение питания, В'))
                ->add('zashitaot380', 'text', array('label' => 'Защита от 380, В'))
                ->add('zashitaotKorotkogozamika', 'text', array('label' => 'Защита от короткого замыкания'))
                ->add('ZashitaOtholostogoHoda', 'text', array('label' => 'Защита от холостого хода'))
                ->add('zashitaOtPerenapryajeniya', 'text', array('label' => 'Защита от перенапряжения'))
                ->add('chastota', 'text', array('label' => 'Частота, Гц '))
                ->add('koefpower', 'text', array('label' => 'Коэффициент мощности ИП,'))
                ->add('stepenzahistiIstochnikapitaniya', 'text', array('label' => 'Степень защиты источника питания, IP'))
                ->add('elektromagnitnayasovmest', 'text', array('label' => 'Электромагнитная совместимость (радиопомехи) по ГОСТ,'))
                ->add('galvanicheskIzol', 'text', array('label' => 'Гальваническая изоляция'))
                ->add('probivnoeNapryajenie', 'text', array('label' => 'Пробивное напряжение , кВ'))
                ->add('soprotivlenieIzolatsii', 'text', array('label' => 'Сопротивление изоляции, Мом '))
                ->add('gabariti', 'text', array('label' => 'Габаритные размеры светильника ( ДхШхВ), мм'))
                ->add('massanetto', 'text', array('label' => 'Масса нетто, Кг'))
                ->add('kolvovKorobke', 'text', array('label' => 'Количество светильников в коробке, шт'))
                ->add('gabaritiKorobki', 'text', array('label' => 'Габариты коробки, ( ДхШхВ), мм '))
                ->add('obiomkorobki', 'text', array('label' => 'Объем коробки, м3'))
                ->add('massaBrutto', 'text', array('label' => 'Масса брутто, Кг '))
                ->add('vidKlimatichispol', 'text', array('label' => 'Вид климатического исполнения'))
                ->add('submit', 'submit', array('label' => 'Добавить'))
                ->getForm();
        $form->setData($products);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($products);
                $em->flush();
                $msg = "Товар был успешно обновлён!";
                $url = "/fixtures/fito/$id";

                return $this->redirect($url);
            }
        }

        return $this->render('ProjectBundle:Admin:editfitofixture.html.twig', array(''
                    . 'form' => $form->createView(), ''
                    . 'id' => $id));
    }
    
    /**
     * @Route("/admin/editafix/{id}", name="editazsFixture")
     */
    public function editazsFixtureAction($id, Request $request) {
        $products = $this->getDoctrine()->getRepository("ProjectBundle:azsFixture")
                ->findOneBy(array('id' => $id));
        if (!$products) {
            $error = "Товар не найден";
            return $this->render("ProjectBundle:Admin:error.html.twig", array(''
                        . 'error' => $error));
        }
        $form = $this->createFormBuilder($products)
                ->add('name', 'text', array('label' => 'Имя светильника'))
                ->add('power', 'number', array('label' => 'Мощность(вт)'))
                ->add('lightflow', 'number', array('label' => 'Световой поток(лм)'))
                ->add('degreeprotection', 'number', array('label' => 'Степень защиты(ip)'))
                ->add('shortDesc', 'textarea', array('label' => 'Короткое описание'))
                ->add('fullDesc', 'textarea', array('label' => 'Полное описание'))
                ->add('picture', 'textarea', array('label' => 'Картинка(URL)'))
                ->add('appointmentTwo', 'text', array('label' => 'Назначение два'))
                ->add('sumsvetpotok', 'text', array('label' => 'Суммарный световой поток с учетом потерь,Лм'))
                ->add('koefpulsatsiy', 'text', array('label' => 'Коэффициент пульсаций светового потока, %'))
                ->add('markasvetodioda', 'text', array('label' => 'Марка светодиода O'))
                ->add('kolvosvetodiodov', 'text', array('label' => 'Количество светодиодов, Шт'))
                ->add('rabresurssvetodiodov', 'text', array('label' => 'Рабочий ресурс светодиодов, Ч'))
                ->add('rabtoksvetodiodov', 'text', array('label' => 'Рабочий ток светодиодов, мА'))
                ->add('svetpotokodnogo', 'text', array('label' => 'Световой поток одного светодиода, Лм'))
                ->add('kriviesilisveta', 'text', array('label' => 'Кривые силы света (КСС) Д'))
                ->add('tsvetovayatemp', 'text', array('label' => 'Цветовая температура, К'))
                ->add('indextsvetoperedachi', 'text', array('label' => 'Индекс цветопередачи'))
                ->add('vremyavklucheniya', 'text', array('label' => 'Время включения светильника, С '))
                ->add('materialrasseivatelya', 'text', array('label' => 'Материал рассеивателя '))
                ->add('kolvoistochnikov', 'text', array('label' => 'Количество источников питания'))
                ->add('materialmontajnihplat', 'text', array('label' => 'Материал монтажных плат '))
                ->add('materialkorpusa', 'text', array('label' => 'Материал корпуса'))
                ->add('sposopkrepleniya', 'text', array('label' => 'Способ крепления светильника '))
                ->add('klasszashitiottoka', 'text', array('label' => 'Класс защиты от поражения электрическим током '))
                ->add('temperaturaekspluataciy', 'text', array('label' => 'Температура эксплуатации, °С '))
                ->add('garantiya', 'text', array('label' => 'Гарантия, мес'))
                ->add('proizvoditelistochnikapitaniya', 'text', array('label' => 'Производитель источника питания '))
                ->add('model', 'text', array('label' => 'Модель'))
                ->add('grozozashita', 'text', array('label' => 'Грозозащита'))
                ->add('previshenievihnapryaz', 'text', array('label' => 'Превышение выходного напряжения'))
                ->add('napryazeniepitaniya', 'text', array('label' => 'Напряжение питания, В'))
                ->add('termozashita', 'text', array('label' => 'Термозащита'))
                ->add('zashitaot380', 'text', array('label' => 'Защита от 380, В'))
                ->add('zashitaotKorotkogozamika', 'text', array('label' => 'Защита от короткого замыкания'))
                ->add('ZashitaOtholostogoHoda', 'text', array('label' => 'Защита от холостого хода'))
                ->add('zashitaOtPerenapryajeniya', 'text', array('label' => 'Защита от перенапряжения'))
                ->add('chastota', 'text', array('label' => 'Частота, Гц '))
                ->add('koefpower', 'text', array('label' => 'Коэффициент мощности ИП,'))
                ->add('stepenzahistiIstochnikapitaniya', 'text', array('label' => 'Степень защиты источника питания, IP'))
                ->add('elektromagnitnayasovmest', 'text', array('label' => 'Электромагнитная совместимость (радиопомехи) по ГОСТ,'))
                ->add('galvanicheskIzol', 'text', array('label' => 'Гальваническая изоляция'))
                ->add('probivnoeNapryajenie', 'text', array('label' => 'Пробивное напряжение , кВ'))
                ->add('soprotivlenieIzolatsii', 'text', array('label' => 'Сопротивление изоляции, Мом '))
                ->add('gabariti', 'text', array('label' => 'Габаритные размеры светильника ( ДхШхВ), мм'))
                ->add('massanetto', 'text', array('label' => 'Масса нетто, Кг'))
                ->add('kolvovKorobke', 'text', array('label' => 'Количество светильников в коробке, шт'))
                ->add('gabaritiKorobki', 'text', array('label' => 'Габариты коробки, ( ДхШхВ), мм '))
                ->add('obiomkorobki', 'text', array('label' => 'Объем коробки, м3'))
                ->add('massaBrutto', 'text', array('label' => 'Масса брутто, Кг '))
                ->add('vidKlimatichispol', 'text', array('label' => 'Вид климатического исполнения'))
                ->add('klassopasnosti', 'text', array('label' => 'Класс опасности утилизации отходов'))
                ->add('indexEnergoeffect', 'text', array('label' => 'Индекс энергоэффективности (EEI) '))
                ->add('ploshadTeplootvodPoverhn', 'text', array('label' => 'Площадь теплоотводящей поверхности, Мм2'))
                ->add('teplovidelenie', 'text', array('label' => 'Тепловыделение (BTU) '))
                ->add('submit', 'submit', array('label' => 'Добавить'))
                ->getForm();
        $form->setData($products);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($products);
                $em->flush();
                $msg = "Товар был успешно обновлён!";
                $url = "/fixtures/azs/$id";

                return $this->redirect($url);
            }
        }

        return $this->render('ProjectBundle:Admin:editazsfixture.html.twig', array(''
                    . 'form' => $form->createView(), ''
                    . 'id' => $id));
    }

    /**
     * @Route("/admin/delpromf/{id}", name="delpromf")
     */
    public function deletepromFixtureAction($id) {
        $product = $this->getDoctrine()->getRepository('ProjectBundle:promFixture')
                ->findOneBy(array('id' => $id));
        if (!$product) {
            $error = "Продукт не найден";
            return $this->render('ProjectBundle:Admin:error.html.twig', array(''
                        . 'error' => $error));
        }
        $em = $this->getDoctrine()->getManager();
        $em->remove($product);
        $em->flush();
        return $this->redirectToRoute('info');
    }
    
    /**
     * @Route("/admin/delofficef/{id}", name="delofficef")
     */
    public function deleteofficeFixtureAction($id) {
        $product = $this->getDoctrine()->getRepository('ProjectBundle:officeFixture')
                ->findOneBy(array('id' => $id));
        if (!$product) {
            $error = "Продукт не найден";
            return $this->render('ProjectBundle:Admin:error.html.twig', array(''
                        . 'error' => $error));
        }
        $em = $this->getDoctrine()->getManager();
        $em->remove($product);
        $em->flush();
        return $this->redirectToRoute('info');
    }
    
    /**
     * @Route("/admin/deltorgf/{id}", name="deltorgf")
     */
    public function deletetorgFixtureAction($id) {
        $product = $this->getDoctrine()->getRepository('ProjectBundle:torgFixture')
                ->findOneBy(array('id' => $id));
        if (!$product) {
            $error = "Продукт не найден";
            return $this->render('ProjectBundle:Admin:error.html.twig', array(''
                        . 'error' => $error));
        }
        $em = $this->getDoctrine()->getManager();
        $em->remove($product);
        $em->flush();
        return $this->redirectToRoute('info');
    }
    
    /**
     * @Route("/admin/delstreetf/{id}", name="delstreetf")
     */
    public function deletestreetFixtureAction($id) {
        $product = $this->getDoctrine()->getRepository('ProjectBundle:streetFixture')
                ->findOneBy(array('id' => $id));
        if (!$product) {
            $error = "Продукт не найден";
            return $this->render('ProjectBundle:Admin:error.html.twig', array(''
                        . 'error' => $error));
        }
        $em = $this->getDoctrine()->getManager();
        $em->remove($product);
        $em->flush();
        return $this->redirectToRoute('info');
    }
    
    /**
     * @Route("/admin/delfitof/{id}", name="delfitof")
     */
    public function deletefitoFixtureAction($id) {
        $product = $this->getDoctrine()->getRepository('ProjectBundle:fitoFixture')
                ->findOneBy(array('id' => $id));
        if (!$product) {
            $error = "Продукт не найден";
            return $this->render('ProjectBundle:Admin:error.html.twig', array(''
                        . 'error' => $error));
        }
        $em = $this->getDoctrine()->getManager();
        $em->remove($product);
        $em->flush();
        return $this->redirectToRoute('info');
    }
    
    /**
     * @Route("/admin/delazsf/{id}", name="delazsf")
     */
    public function deleteazsFixtureAction($id) {
        $product = $this->getDoctrine()->getRepository('ProjectBundle:azsFixture')
                ->findOneBy(array('id' => $id));
        if (!$product) {
            $error = "Продукт не найден";
            return $this->render('ProjectBundle:Admin:error.html.twig', array(''
                        . 'error' => $error));
        }
        $em = $this->getDoctrine()->getManager();
        $em->remove($product);
        $em->flush();
        return $this->redirectToRoute('info');
    }

    /**
     * @Route("/admin/createproduct/lamp", name="createlamp")
     */
    public function createLampAction(Request $request) {
        $userManager = $this->get('fos_user.user_manager');
        $lamp = new ASD();
     

        $form = $this->createFormBuilder($lamp)
                ->add('name', 'text', array('label' => 'Имя лампы'))
                ->add('prodaction', 'text', array('label' => 'Производитель'))
                ->add('forma', 'text', array('label' => 'Форма'))
                ->add('chokol', 'text', array('label' => 'Цоколь'))
                ->add('shortDesc', 'textarea', array('label' => 'Короткое описание'))
                ->add('power', 'number', array('label' => 'Мощность'))
                ->add('img', 'textarea', array('label' => 'Картинка(URL)'))
                ->add('poverhnost', 'text', array('label' => 'Поверхность'))
				->add('submit', 'submit', array('label' => 'Добавить'))
                ->getForm();
        $form->setData($lamp);


        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($lamp);
                $em->flush();
                $msg = "Товар был успешно добавлен";
                return $this->render('ProjectBundle:Admin:createlamp.html.twig', array(''
                            . 'message' => $msg));
            }
        }

        return $this->render('ProjectBundle:Admin:createlamp.html.twig', array(''
                    . 'form' => $form->createView()));
    }

}

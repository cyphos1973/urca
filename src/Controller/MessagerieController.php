<?php

    namespace App\Controller;

    use App\Entity\Document;
    use App\Entity\Messagerie;
    use App\Form\MessagerieType;
    use App\Repository\MessagerieRepository;
    use App\Service\FileUploader;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Routing\Annotation\Route;

    /**
     * @Route("/admin/messagerie", name="messagerie_")
     */
    class MessagerieController extends AbstractController
    {
        /**
         * @Route("/", name="index")
         */
        public function index(MessagerieRepository $messages, FileUploader $fileUploader): Response
        {
            $messagesRecus = $this->getDoctrine()
                ->getRepository(Messagerie::class)
                ->getMessagesRecus($this->getUser());

            $messagesEnvoyes = $this->getDoctrine()
                ->getRepository(Messagerie::class)
                ->getMessagesEnvoyes($this->getUser());

            return $this->render('backend/messagerie/index.html.twig', [
                'messagesEnvoyes' => $messagesEnvoyes,
                'messagesRecus' => $messagesRecus
            ]);
        }

        /**
         * @Route("/new", name="new", methods={"GET","POST"})
         */
        public function new(Request $request): Response
        {
            $message = new Messagerie();
            $form = $this->createForm(MessagerieType::class, $message);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $documents = $form->get('documents')->getData();

                if ($documents) {
                    $originalFilename = pathinfo($documents->getClientOriginalName(), PATHINFO_FILENAME);
                    // this is needed to safely include the file name as part of the URL
                    $safeFilename = transliterator_transliterate('Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()', $originalFilename);
                    $newFilename = $safeFilename . '-' . uniqid() . '.' . $documents->guessExtension();
                    $documents->move(
                        $this->getParameter('docs_directory'),
                        $newFilename
                    );

                    $doc = new Document();
                    $doc->setTitle($originalFilename);
                    $doc->setPath($newFilename);
                    $message->addDocument($doc);
                }
                $message->setDateSended(new \DateTime('now'));
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($message);
                $entityManager->flush();
                $this->addFlash('success', 'Votre message a été bien envoyé. Merci');
                return $this->redirectToRoute('messagerie_index');
            }

            return $this->render('backend/messagerie/new.html.twig', [
                'message' => $message,
                'form' => $form->createView(),
            ]);
        }

        /**
         * @Route("/show/{id}", name="show", methods={"GET"})
         */
        public function show(Messagerie $message): Response
        {
            return $this->render('backend/messagerie/show.html.twig', [
                'message' => $message,
            ]);
        }
    }

<?php

namespace App\DataFixtures;

use App\Entity\Comment;
use App\Entity\Group;
use App\Entity\Image;
use App\Entity\Trick;
use App\Entity\User;
use App\Entity\Video;
use App\Repository\UserRepository;
use App\Repository\GroupRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class AppFixtures extends Fixture {
    /**
    * @var UserPasswordEncoderInterface
     */
    private $userPasswordEncoder;

    /**
     * @var UserRepository
     */
    private $userRepository;
    /**
     * @var groupRepository
     */
    private $groupRepository;

    /**
     * @param UserPasswordEncoderInterface $userPasswordEncoder
     * @param $userRepository
     */
    public function __construct(UserPasswordEncoderInterface $userPasswordEncoder,UserRepository $userRepository,GroupRepository $groupRepository)
    {
        $this->userPasswordEncoder = $userPasswordEncoder;
        $this->userRepository = $userRepository;
        $this->groupRepository = $groupRepository;
    }

    public function load(ObjectManager $manager)
    {
        $arrayGroup = [];
        $arrayGroup[1]['name'] = "Grabs";;
        $arrayGroup[1]['description'] = "Un grab consiste à attraper la planche avec la main pendant le saut. Le verbe anglais to grab signifie « attraper. »";;
        $arrayGroup[2]['name'] = "Slide";
        $arrayGroup[2]['description'] = "Un slide consiste à glisser sur une barre de slide. Le slide se fait soit avec la planche dans l'axe de la barre, soit perpendiculaire, soit plus ou moins désaxé.";
        $arrayGroup[3]['name'] = "Flip";
        $arrayGroup[3]['description'] = "Un flip est une rotation verticale. On distingue les front flips, rotations en avant, et les back flips, rotations en arrière.";

        $arrayUser = [];
        $arrayUser[1]['name'] = "Khyshant";
        $arrayUser[1]['email'] = "anth.blanchard@gmail.com";
        $arrayUser[1]['password'] = "azerty123";
        $arrayUser[1]['dateadd'] = "2020-06-22 00:00:01";
        $arrayUser[1]['avatar'] = "avatar7";
        $arrayUser[2]['name'] = "Usertest";
        $arrayUser[2]['email'] = "khyshant@msn.com";
        $arrayUser[2]['password'] = "azerty123";
        $arrayUser[2]['dateadd'] = "2020-06-22 00:00:01";
        $arrayUser[2]['avatar'] = "avatar1";

        $arrayTrick[1]['title'] = "Mute";
        $arrayTrick[1]['description'] = "La main avant saisit la pointe des pieds entre les orteils ou devant le pied avant. Les variations incluent le Mute Stiffy, dans lequel une prise de silence est effectuée tout en redressant les deux jambes, ou alternativement, certains snowboarders attraperont muet et feront pivoter le bord avant de 90 degrés.";
        $arrayTrick[1]['metatitle'] = "Mute";
        $arrayTrick[1]['metadescription'] = "La main avant saisit la pointe des pieds entre les orteils ou devant le pied avant. Les variations incluent le Mute Stiffy, dans lequel une prise de silence est effectuée tout en redressant les deux jambes, ou alternativement, certains snowboarders attraperont muet et feront pivoter le bord avant de 90 degrés.";
        $arrayTrick[1]['isValid'] = "1";
        $arrayTrick[1]['author'] = 1;
        $arrayTrick[1]['group'] = "1";
        $arrayTrick[1]['images'][1]['path'] = "image1.png";
        $arrayTrick[1]['images'][2]['path'] = "image2.png";
        $arrayTrick[1]['images'][3]['path'] = "image3.png";
        $arrayTrick[1]['videos'][1]['path'] = "https://youtu.be/SZMhCZ0MIbk";
        $arrayTrick[1]['comment'][1]['comment'] = "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor";
        $arrayTrick[1]['comment'][1]['isValid'] = "1";
        $arrayTrick[1]['comment'][1]['author'] = "2";
        $arrayTrick[1]['comment'][2]['comment'] = "Ut enim ad minim veniam, quis";
        $arrayTrick[1]['comment'][2]['isValid'] = "1";
        $arrayTrick[1]['comment'][2]['author'] = "1";
        $arrayTrick[1]['comment'][3]['comment'] = "Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium";
        $arrayTrick[1]['comment'][3]['isValid'] = "1";
        $arrayTrick[1]['comment'][3]['author'] = "2";
        $arrayTrick[1]['comment'][4]['comment'] = "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor";
        $arrayTrick[1]['comment'][4]['isValid'] = "1";
        $arrayTrick[1]['comment'][4]['author'] = "2";
        $arrayTrick[1]['comment'][5]['comment'] = "But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain ";
        $arrayTrick[1]['comment'][5]['isValid'] = "1";
        $arrayTrick[1]['comment'][5]['author'] = "1";
        $arrayTrick[1]['comment'][6]['comment'] = "because it is pain, but because occasionally circumstances occur in which toil and pain can procure ";
        $arrayTrick[1]['comment'][6]['isValid'] = "1";
        $arrayTrick[1]['comment'][6]['author'] = "2";

        $arrayTrick[2]['title'] = "Backside air";
        $arrayTrick[2]['description'] = "Le grab star du snowboard qui peut être fait d'autant de façon différentes qu'il y a de styles de riders. Il consiste à attraper la carre arrière entre les pieds, ou légèrement devant, et à pousser avec sa jambe arrière pour ramener la planche devant. C'est une figure phare en pipe ou sur un hip en backside. C'est généralement avec ce trick que les riders vont le plus haut.";
        $arrayTrick[2]['metatitle'] = "Backside air";
        $arrayTrick[2]['metadescription'] = "Le grab star du snowboard qui peut être fait d'autant de façon différentes qu'il y a de styles de riders. Il consiste à attraper la carre arrière entre les pieds, ou légèrement devant, et à pousser avec sa jambe arrière pour ramener la planche devant. C'est une figure phare en pipe ou sur un hip en backside. C'est généralement avec ce trick que les riders vont le plus haut.";
        $arrayTrick[2]['isValid'] = "1";
        $arrayTrick[2]['author'] = "1";
        $arrayTrick[2]['group'] = "2";
        $arrayTrick[2]['images'][1]['path'] = "image4.png";
        $arrayTrick[2]['images'][2]['path'] = "image5.png";
        $arrayTrick[2]['images'][3]['path'] = "image6.png";
        $arrayTrick[2]['videos'][1]['path'] = "https://youtu.be/gnVupEzu59g";
        $arrayTrick[2]['comment'][1]['comment'] = "Backside air Lorem ipsum  tempor";
        $arrayTrick[2]['comment'][1]['isValid'] = "1";
        $arrayTrick[2]['comment'][1]['author'] = "1";
        $arrayTrick[2]['comment'][2]['comment'] = "Backside air Ut enim ad minim veniam, quis";
        $arrayTrick[2]['comment'][2]['isValid'] = "1";
        $arrayTrick[2]['comment'][2]['author'] = "1";
        $arrayTrick[2]['comment'][3]['comment'] = "Backside air Sed ut perspiciatis unde sit voluptatem accusantium doloremque laudantium";
        $arrayTrick[2]['comment'][3]['isValid'] = "1";
        $arrayTrick[2]['comment'][3]['author'] = "2";
        $arrayTrick[2]['comment'][4]['comment'] = "Backside air  consectetur adipiscing elit, sed do eiusmod tempor";
        $arrayTrick[2]['comment'][4]['isValid'] = "1";
        $arrayTrick[2]['comment'][4]['author'] = "2";
        $arrayTrick[2]['comment'][5]['comment'] = "Backside air But I must explain this mistaken idea of denouncing pleasure and praising pain ";
        $arrayTrick[2]['comment'][5]['isValid'] = "1";
        $arrayTrick[2]['comment'][5]['author'] = "1";
        $arrayTrick[2]['comment'][6]['comment'] = "Backside air because it is pain, but circumstances occur in which toil and pain can procure ";
        $arrayTrick[2]['comment'][6]['isValid'] = "1";
        $arrayTrick[2]['comment'][6]['author'] = "2";

        $arrayTrick[3]['title'] = "Backside rodeo";
        $arrayTrick[3]['description'] = "Une rotation tête en bas backside tournant dans le sens d'un backflip qui peut se faire aussi bien sur un kicker, un pipe ou un hip.";
        $arrayTrick[3]['metatitle'] = "Backside rodeo";
        $arrayTrick[3]['metadescription'] = "Une rotation tête en bas backside tournant dans le sens d'un backflip qui peut se faire aussi bien sur un kicker, un pipe ou un hip.";
        $arrayTrick[3]['isValid'] = "1";
        $arrayTrick[3]['author'] = 1;
        $arrayTrick[3]['group'] = "3";
        $arrayTrick[3]['images'][1]['path'] = "image7.png";
        $arrayTrick[3]['images'][2]['path'] = "image8.png";
        $arrayTrick[3]['images'][3]['path'] = "image1.png";
        $arrayTrick[3]['videos'][1]['path'] = "https://youtu.be/gnVupEzu59g";
        $arrayTrick[3]['comment'][1]['comment'] = "Backside rodeo Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor";
        $arrayTrick[3]['comment'][1]['isValid'] = "1";
        $arrayTrick[3]['comment'][1]['author'] = "2";
        $arrayTrick[3]['comment'][2]['comment'] = "Backside rodeo Ut enim ad minim veniam, quis";
        $arrayTrick[3]['comment'][2]['isValid'] = "1";
        $arrayTrick[3]['comment'][2]['author'] = "1";
        $arrayTrick[3]['comment'][3]['comment'] = "Backside rodeo Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium";
        $arrayTrick[3]['comment'][3]['isValid'] = "1";
        $arrayTrick[3]['comment'][3]['author'] = "2";
        $arrayTrick[3]['comment'][4]['comment'] = "Backside rodeo Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor";
        $arrayTrick[3]['comment'][4]['isValid'] = "1";
        $arrayTrick[3]['comment'][4]['author'] = "2";
        $arrayTrick[3]['comment'][5]['comment'] = "Backside rodeo  But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain ";
        $arrayTrick[3]['comment'][5]['isValid'] = "1";
        $arrayTrick[3]['comment'][5]['author'] = "1";
        $arrayTrick[3]['comment'][6]['comment'] = "Backside rodeo because it is pain, but because occasionally circumstances occur in which toil and pain can procure ";
        $arrayTrick[3]['comment'][6]['isValid'] = "1";
        $arrayTrick[3]['comment'][6]['author'] = "2";

        $arrayTrick[4]['title'] = "Backside Triple Cork";
        $arrayTrick[4]['description'] = "En langage snowboard, un cork est une rotation horizontale plus ou moins désaxée, selon un mouvement d'épaules effectué juste au moment du saut. Le tout premier Triple Cork a été plaqué par Mark McMorris en 2011, lequel a récidivé lors des Winter X Games 2012... avant de se faire voler la vedette par Torstein Horgmo, lors de ce même championnat. Le Norvégien réalisa son propre Backside Triple Cork 1440 et obtint la note parfaite de 50/50. ";
        $arrayTrick[4]['metatitle'] = "Backside Triple Cork";
        $arrayTrick[4]['metadescription'] = "En langage snowboard, un cork est une rotation horizontale plus ou moins désaxée, selon un mouvement d'épaules effectué juste au moment du saut. Le tout premier Triple Cork a été plaqué par Mark McMorris en 2011, lequel a récidivé lors des Winter X Games 2012... avant de se faire voler la vedette par Torstein Horgmo, lors de ce même championnat. Le Norvégien réalisa son propre Backside Triple Cork 1440 et obtint la note parfaite de 50/50. ";
        $arrayTrick[4]['isValid'] = "1";
        $arrayTrick[4]['author'] = 1;
        $arrayTrick[4]['group'] = "2";
        $arrayTrick[4]['images'][1]['path'] = "image2.png";
        $arrayTrick[4]['images'][2]['path'] = "image4.png";
        $arrayTrick[4]['images'][3]['path'] = "image6.png";
        $arrayTrick[4]['videos'][1]['path'] = "https://youtu.be/gnVupEzu59g";
        $arrayTrick[4]['comment'][1]['comment'] = "Backside Triple Cork Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor";
        $arrayTrick[4]['comment'][1]['isValid'] = "1";
        $arrayTrick[4]['comment'][1]['author'] = "2";
        $arrayTrick[4]['comment'][2]['comment'] = "Backside Triple Cork Ut enim ad minim veniam, quis";
        $arrayTrick[4]['comment'][2]['isValid'] = "1";
        $arrayTrick[4]['comment'][2]['author'] = "1";
        $arrayTrick[4]['comment'][3]['comment'] = "Backside Triple Cork Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium";
        $arrayTrick[4]['comment'][3]['isValid'] = "1";
        $arrayTrick[4]['comment'][3]['author'] = "2";
        $arrayTrick[4]['comment'][4]['comment'] = "Backside Triple Cork Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor";
        $arrayTrick[4]['comment'][4]['isValid'] = "1";
        $arrayTrick[4]['comment'][4]['author'] = "2";
        $arrayTrick[4]['comment'][5]['comment'] = "Backside Triple Cork But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain ";
        $arrayTrick[4]['comment'][5]['isValid'] = "1";
        $arrayTrick[4]['comment'][5]['author'] = "1";
        $arrayTrick[4]['comment'][6]['comment'] = "Backside Triple Cork because it is pain, but because occasionally circumstances occur in which toil and pain can procure ";
        $arrayTrick[4]['comment'][6]['isValid'] = "1";
        $arrayTrick[4]['comment'][6]['author'] = "2";

        $arrayTrick[5]['title'] = "Cork";
        $arrayTrick[5]['description'] = "Le diminutif de corkscrew qui signifie littéralement tire-bouchon et désignait les premières simples rotations têtes en bas en frontside. Désormais, on utilise le mot cork à toute les sauces pour qualifier les figures où le rider passe la tête en bas, peu importe le sens de rotation. Et dorénavant en compétition, on parle souvent de double cork, triple cork et certains riders vont jusqu'au quadruple cork ! ";
        $arrayTrick[5]['metatitle'] = "Cork";
        $arrayTrick[5]['metadescription'] = "Le diminutif de corkscrew qui signifie littéralement tire-bouchon et désignait les premières simples rotations têtes en bas en frontside. Désormais, on utilise le mot cork à toute les sauces pour qualifier les figures où le rider passe la tête en bas, peu importe le sens de rotation. Et dorénavant en compétition, on parle souvent de double cork, triple cork et certains riders vont jusqu'au quadruple cork ! ";
        $arrayTrick[5]['isValid'] = "1";
        $arrayTrick[5]['author'] = 1;
        $arrayTrick[5]['group'] = "3";
        $arrayTrick[5]['images'][1]['path'] = "image8.png";
        $arrayTrick[5]['images'][2]['path'] = "image1.png";
        $arrayTrick[5]['images'][3]['path'] = "image3.png";
        $arrayTrick[5]['videos'][1]['path'] = "";
        $arrayTrick[5]['comment'][1]['comment'] = "Cork Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor";
        $arrayTrick[5]['comment'][1]['isValid'] = "1";
        $arrayTrick[5]['comment'][1]['author'] = "2";
        $arrayTrick[5]['comment'][2]['comment'] = "Cork Ut enim ad minim veniam, quis";
        $arrayTrick[5]['comment'][2]['isValid'] = "1";
        $arrayTrick[5]['comment'][2]['author'] = "1";
        $arrayTrick[5]['comment'][3]['comment'] = "Cork Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium";
        $arrayTrick[5]['comment'][3]['isValid'] = "1";
        $arrayTrick[5]['comment'][3]['author'] = "2";
        $arrayTrick[5]['comment'][4]['comment'] = "Cork Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor";
        $arrayTrick[5]['comment'][4]['isValid'] = "1";
        $arrayTrick[5]['comment'][4]['author'] = "2";
        $arrayTrick[5]['comment'][5]['comment'] = "Cork But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain ";
        $arrayTrick[5]['comment'][5]['isValid'] = "1";
        $arrayTrick[5]['comment'][5]['author'] = "1";
        $arrayTrick[5]['comment'][6]['comment'] = "Cork because it is pain, but because occasionally circumstances occur in which toil and pain can procure ";
        $arrayTrick[5]['comment'][6]['isValid'] = "1";
        $arrayTrick[5]['comment'][6]['author'] = "2";

        $arrayTrick[6]['title'] = "Crippler";
        $arrayTrick[6]['description'] = "Une autre rotation tête en bas classique qui s'apparente à un backflip sur un mur frontside de pipe ou un quarter.";
        $arrayTrick[6]['metatitle'] = "Crippler";
        $arrayTrick[6]['metadescription'] = "Une autre rotation tête en bas classique qui s'apparente à un backflip sur un mur frontside de pipe ou un quarter.";
        $arrayTrick[6]['isValid'] = "1";
        $arrayTrick[6]['author'] = 1;
        $arrayTrick[6]['group'] = "1";
        $arrayTrick[6]['images'][1]['path'] = "image5.png";
        $arrayTrick[6]['images'][2]['path'] = "image7.png";
        $arrayTrick[6]['images'][3]['path'] = "image8.png";
        $arrayTrick[6]['videos'][1]['path'] = "https://youtu.be/gnVupEzu59g";
        $arrayTrick[6]['comment'][1]['comment'] = "Crippler Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor";
        $arrayTrick[6]['comment'][1]['isValid'] = "1";
        $arrayTrick[6]['comment'][1]['author'] = "2";
        $arrayTrick[6]['comment'][2]['comment'] = "Crippler Ut enim ad minim veniam, quis";
        $arrayTrick[6]['comment'][2]['isValid'] = "1";
        $arrayTrick[6]['comment'][2]['author'] = "1";
        $arrayTrick[6]['comment'][3]['comment'] = "Crippler Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium";
        $arrayTrick[6]['comment'][3]['isValid'] = "1";
        $arrayTrick[6]['comment'][3]['author'] = "2";
        $arrayTrick[6]['comment'][4]['comment'] = "Crippler Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor";
        $arrayTrick[6]['comment'][4]['isValid'] = "1";
        $arrayTrick[6]['comment'][4]['author'] = "2";
        $arrayTrick[6]['comment'][5]['comment'] = "Crippler But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain ";
        $arrayTrick[6]['comment'][5]['isValid'] = "1";
        $arrayTrick[6]['comment'][5]['author'] = "1";
        $arrayTrick[6]['comment'][6]['comment'] = "Crippler because it is pain, but because occasionally circumstances occur in which toil and pain can procure ";
        $arrayTrick[6]['comment'][6]['isValid'] = "1";
        $arrayTrick[6]['comment'][6]['author'] = "2";

        $arrayTrick[7]['title'] = "Double Backflip One Foot";
        $arrayTrick[7]['description'] = "Comme on peut le deviner, les \"one foot\" sont des figures réalisées avec un pied décroché de la fixation. Pendant le saut, le snowboarder doit tendre la jambe du côté dudit pied. L'esthète Scotty Vine – une sorte de Danny Macaskill du snowboard – en a réalisé un bel exemple avec son Double Backflip One Foot. ";
        $arrayTrick[7]['metatitle'] = "Double Backflip One Foot";
        $arrayTrick[7]['metadescription'] = "Comme on peut le deviner, les \"one foot\" sont des figures réalisées avec un pied décroché de la fixation. Pendant le saut, le snowboarder doit tendre la jambe du côté dudit pied. L'esthète Scotty Vine – une sorte de Danny Macaskill du snowboard – en a réalisé un bel exemple avec son Double Backflip One Foot. ";
        $arrayTrick[7]['isValid'] = "1";
        $arrayTrick[7]['author'] = 1;
        $arrayTrick[7]['group'] = "2";
        $arrayTrick[7]['images'][1]['path'] = "image2.png";
        $arrayTrick[7]['images'][2]['path'] = "image4.png";
        $arrayTrick[7]['images'][3]['path'] = "image1.png";
        $arrayTrick[7]['videos'][1]['path'] = "https://youtu.be/-27nqjI844I";
        $arrayTrick[7]['comment'][1]['comment'] = "Double Backflip One Foot Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor";
        $arrayTrick[7]['comment'][1]['isValid'] = "1";
        $arrayTrick[7]['comment'][1]['author'] = "2";
        $arrayTrick[7]['comment'][2]['comment'] = "Double Backflip One Foot Ut enim ad minim veniam, quis";
        $arrayTrick[7]['comment'][2]['isValid'] = "1";
        $arrayTrick[7]['comment'][2]['author'] = "1";
        $arrayTrick[7]['comment'][3]['comment'] = "Double Backflip One Foot Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium";
        $arrayTrick[7]['comment'][3]['isValid'] = "1";
        $arrayTrick[7]['comment'][3]['author'] = "2";
        $arrayTrick[7]['comment'][4]['comment'] = "Double Backflip One Foot Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor";
        $arrayTrick[7]['comment'][4]['isValid'] = "1";
        $arrayTrick[7]['comment'][4]['author'] = "2";
        $arrayTrick[7]['comment'][5]['comment'] = "Double Backflip One Foot But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain ";
        $arrayTrick[7]['comment'][5]['isValid'] = "1";
        $arrayTrick[7]['comment'][5]['author'] = "1";
        $arrayTrick[7]['comment'][6]['comment'] = "Double Backflip One Foot because it is pain, but because occasionally circumstances occur in which toil and pain can procure ";
        $arrayTrick[7]['comment'][6]['isValid'] = "1";
        $arrayTrick[7]['comment'][6]['author'] = "2";

        $arrayTrick[8]['title'] = "Japan";
        $arrayTrick[8]['description'] = "saisie du ski opposé (main droite qui attrape le ski gauche, ou l’inverse) à l’arrière de la fixation, en passant derrière la jambe, souvent en repliant la jambe grabée. ";
        $arrayTrick[8]['metatitle'] = "Japan";
        $arrayTrick[8]['metadescription'] = "saisie du ski opposé (main droite qui attrape le ski gauche, ou l’inverse) à l’arrière de la fixation, en passant derrière la jambe, souvent en repliant la jambe grabée. ";
        $arrayTrick[8]['isValid'] = "1";
        $arrayTrick[8]['author'] = 1;
        $arrayTrick[8]['group'] = "1";
        $arrayTrick[8]['images'][1]['path'] = "image1.png";
        $arrayTrick[8]['images'][2]['path'] = "image5.png";
        $arrayTrick[8]['images'][3]['path'] = "image8.png";
        $arrayTrick[8]['videos'][1]['path'] = "";
        $arrayTrick[8]['comment'][1]['comment'] = "Japan orem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor";
        $arrayTrick[8]['comment'][1]['isValid'] = "1";
        $arrayTrick[8]['comment'][1]['author'] = "2";
        $arrayTrick[8]['comment'][2]['comment'] = "Japan Ut enim ad minim veniam, quis";
        $arrayTrick[8]['comment'][2]['isValid'] = "1";
        $arrayTrick[8]['comment'][2]['author'] = "1";
        $arrayTrick[8]['comment'][3]['comment'] = "Japan Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium";
        $arrayTrick[8]['comment'][3]['isValid'] = "1";
        $arrayTrick[8]['comment'][3]['author'] = "2";
        $arrayTrick[8]['comment'][4]['comment'] = "Japan Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor";
        $arrayTrick[8]['comment'][4]['isValid'] = "1";
        $arrayTrick[8]['comment'][4]['author'] = "2";
        $arrayTrick[8]['comment'][5]['comment'] = "Japan But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain ";
        $arrayTrick[8]['comment'][5]['isValid'] = "1";
        $arrayTrick[8]['comment'][5]['author'] = "1";
        $arrayTrick[8]['comment'][6]['comment'] = "Japan because it is pain, but because occasionally circumstances occur in which toil and pain can procure ";
        $arrayTrick[8]['comment'][6]['isValid'] = "1";
        $arrayTrick[8]['comment'][6]['author'] = "2";

        $arrayTrick[9]['title'] = "Mc Twist";
        $arrayTrick[9]['description'] = "Un grand classique des rotations tête en bas qui se fait en backside, sur un mur backside de pipe. Le Mc Twist est généralement fait en japan, un grab très tweaké (action d'accentuer un grab en se contorsionnant).";
        $arrayTrick[9]['metatitle'] = "Mc Twist";
        $arrayTrick[9]['metadescription'] = "Un grand classique des rotations tête en bas qui se fait en backside, sur un mur backside de pipe. Le Mc Twist est généralement fait en japan, un grab très tweaké (action d'accentuer un grab en se contorsionnant).";
        $arrayTrick[9]['isValid'] = "1";
        $arrayTrick[9]['author'] = 1;
        $arrayTrick[9]['group'] = "3";
        $arrayTrick[9]['images'][1]['path'] = "image8.png";
        $arrayTrick[9]['images'][2]['path'] = "image6.png";
        $arrayTrick[9]['images'][3]['path'] = "image7.png";
        $arrayTrick[9]['videos'][1]['path'] = "https://youtu.be/V9xuy-rVj9w";
        $arrayTrick[9]['comment'][1]['comment'] = "Mc Twist Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor";
        $arrayTrick[9]['comment'][1]['isValid'] = "1";
        $arrayTrick[9]['comment'][1]['author'] = "2";
        $arrayTrick[9]['comment'][2]['comment'] = "Ut enim ad minim veniam, quis";
        $arrayTrick[9]['comment'][2]['isValid'] = "1";
        $arrayTrick[9]['comment'][2]['author'] = "1";
        $arrayTrick[9]['comment'][3]['comment'] = "Mc Twist Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium";
        $arrayTrick[9]['comment'][3]['isValid'] = "1";
        $arrayTrick[9]['comment'][3]['author'] = "2";
        $arrayTrick[9]['comment'][4]['comment'] = "Mc Twist orem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor";
        $arrayTrick[9]['comment'][4]['isValid'] = "1";
        $arrayTrick[9]['comment'][4]['author'] = "2";
        $arrayTrick[9]['comment'][5]['comment'] = "Mc Twist But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain ";
        $arrayTrick[9]['comment'][5]['isValid'] = "1";
        $arrayTrick[9]['comment'][5]['author'] = "1";
        $arrayTrick[9]['comment'][6]['comment'] = "Mc Twist because it is pain, but because occasionally circumstances occur in which toil and pain can procure ";
        $arrayTrick[9]['comment'][6]['isValid'] = "1";
        $arrayTrick[9]['comment'][6]['author'] = "2";

        $arrayTrick[10]['title'] = "Revert";
        $arrayTrick[10]['description'] = "Un revert n'est pas une figure à part entière mais c'est le fait de continuer à tourner sur la neige après une rotation aérienne. Cela montre ainsi que la rotation n'est pas contrôlée et ça fait perdre des points en compétition. ";
        $arrayTrick[10]['metatitle'] = "Revert";
        $arrayTrick[10]['metadescription'] = "Un revert n'est pas une figure à part entière mais c'est le fait de continuer à tourner sur la neige après une rotation aérienne. Cela montre ainsi que la rotation n'est pas contrôlée et ça fait perdre des points en compétition. ";
        $arrayTrick[10]['isValid'] = "1";
        $arrayTrick[10]['author'] = 1;
        $arrayTrick[10]['group'] = "3";
        $arrayTrick[10]['images'][1]['path'] = "image1.png";
        $arrayTrick[10]['images'][2]['path'] = "image1.png";
        $arrayTrick[10]['images'][3]['path'] = "image1.png";
        $arrayTrick[10]['videos'][1]['path'] = "https://youtu.be/51sQRIK-TEI";
        $arrayTrick[10]['comment'][1]['comment'] = "Revert Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor";
        $arrayTrick[10]['comment'][1]['isValid'] = "1";
        $arrayTrick[10]['comment'][1]['author'] = "2";
        $arrayTrick[10]['comment'][2]['comment'] = "Revert Ut enim ad minim veniam, quis";
        $arrayTrick[10]['comment'][2]['isValid'] = "1";
        $arrayTrick[10]['comment'][2]['author'] = "1";
        $arrayTrick[10]['comment'][3]['comment'] = "Revert Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium";
        $arrayTrick[10]['comment'][3]['isValid'] = "1";
        $arrayTrick[10]['comment'][3]['author'] = "2";
        $arrayTrick[10]['comment'][4]['comment'] = "Revert Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor";
        $arrayTrick[10]['comment'][4]['isValid'] = "1";
        $arrayTrick[10]['comment'][4]['author'] = "2";
        $arrayTrick[10]['comment'][5]['comment'] = "Revert But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain ";
        $arrayTrick[10]['comment'][5]['isValid'] = "1";
        $arrayTrick[10]['comment'][5]['author'] = "1";
        $arrayTrick[10]['comment'][6]['comment'] = "Revert because it is pain, but because occasionally circumstances occur in which toil and pain can procure ";
        $arrayTrick[10]['comment'][6]['isValid'] = "1";
        $arrayTrick[10]['comment'][6]['author'] = "2";

        foreach ($arrayGroup as $groupValue) {
            $group = new Group();
            $group->setName($groupValue['name']);
            $group->setDescription($groupValue['description']);
            $group->setDateAdd(date('Y-m-d H:i:s'));
            $manager->persist($group);
            $manager->flush();
        }


        foreach ($arrayUser as $user) {
            $trickAuthor = new User();
            $trickAuthor->setUsername($user['name']);
            $trickAuthor->setEmail($user['email']);
            //$trickAuthor->setActivated(1);
            $trickAuthor->setPassword($this->userPasswordEncoder->encodePassword($trickAuthor, 'password'));
            $manager->persist($trickAuthor);
            $manager->flush();
        }

        foreach ($arrayTrick as $trickValue) {
            $trick = new Trick();
            $trick->setTitle($trickValue['title']);
            $trick->setDescription($trickValue['description']);
            $trick->setMetatitle($trickValue['metatitle']);
            $trick->setMetadescription($trickValue['metadescription']);
            $trick->setIsValid(1);
            $trick->setAuthor($this->userRepository->findOneBy(['id' => $trickValue['author']]));
            $trick->setGroup($this->groupRepository->findOneBy(['id' => $trickValue['group']]));
            foreach ($trickValue['comment'] as $commentValue) {
                $comment = new Comment();
                $comment->setComment($commentValue['comment']);
                $comment->setTrick($trick);
                $comment->setIsValid($commentValue['isValid']);
                $comment->setAuthor($this->userRepository->findOneBy(['id' => $commentValue['author']]));
                $trick->addComment($comment);
                $manager->persist($comment);
            }
            foreach ($trickValue['images'] as $imageValue) {
                $image = new Image();
                $image->setPath($imageValue['path']);
                $trick->addImage($image);
                $manager->persist($image);
            }

            foreach ($trickValue['videos'] as $videoValue) {
                $video = new Video();
                $video->setUri($videoValue['path']);
                $trick->addVideo($video);
                $manager->persist($video);
            }
            $trick->setSlug();
            $manager->persist($trick);
            $manager->flush();
        }
    }
}

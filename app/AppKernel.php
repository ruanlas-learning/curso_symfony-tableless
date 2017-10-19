<?php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = [
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
            new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
            new CoreBundle\CoreBundle(),
            //new AppBundle\AppBundle(),
                                        // -> "apagamos" esta linha pois escluímos a pasta AppBundle, no caminho scr/AppBundle. Desta
                                        //forma apagamos o registro deste bundle no AppKernel
                                        //Vamos configurar um bundle do zero ao invés de configurar um já pronto, por isso 
                                        //excluímos a pasta padrão AppBundle com os arquivos dentro.,
            new ModelBundle\ModelBundle(),
            new Knp\Bundle\PaginatorBundle\KnpPaginatorBundle(), //Como acabamos de instalar o Knp Paginator, devemos
            // configurá-lo. Para isto devemos registrar ele neste arquivo 'AppKernel.php' no registro de $bundles
            new Stof\DoctrineExtensionsBundle\StofDoctrineExtensionsBundle(), //Instalamos o StofDoctrineExtensionsBundle e
                                                                                // devemos registrar no AppKernel.php em $bundles

        ];

        if (in_array($this->getEnvironment(), ['dev', 'test'], true)) {
            $bundles[] = new Symfony\Bundle\DebugBundle\DebugBundle();
            $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
            $bundles[] = new Sensio\Bundle\DistributionBundle\SensioDistributionBundle();

            if ('dev' === $this->getEnvironment()) {
                $bundles[] = new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();
                $bundles[] = new Symfony\Bundle\WebServerBundle\WebServerBundle();
            }
        }

        return $bundles;
    }

    public function getRootDir()
    {
        return __DIR__;
    }

    public function getCacheDir()
    {
        return dirname(__DIR__).'/var/cache/'.$this->getEnvironment();
    }

    public function getLogDir()
    {
        return dirname(__DIR__).'/var/logs';
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load($this->getRootDir().'/config/config_'.$this->getEnvironment().'.yml');
    }
}

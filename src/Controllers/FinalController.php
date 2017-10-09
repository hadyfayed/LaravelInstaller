<?php

namespace HadyFayed\LaravelInstaller\Controllers;

use Illuminate\Routing\Controller;
use HadyFayed\LaravelInstaller\Helpers\EnvironmentManager;
use HadyFayed\LaravelInstaller\Helpers\FinalInstallManager;
use HadyFayed\LaravelInstaller\Helpers\InstalledFileManager;

class FinalController extends Controller
{
    /**
     * Update installed file and display finished view.
     *
     * @param InstalledFileManager $fileManager
     * @param FinalInstallManager $finalInstall
     * @param EnvironmentManager $environment
     * @return \Illuminate\View\View
     */
    public function finish(
        InstalledFileManager $fileManager,
        FinalInstallManager $finalInstall,
        EnvironmentManager $environment
    )
    {
        $finalMessages = $finalInstall->runFinal();
        $finalStatusMessage = $fileManager->update();
        $finalEnvFile = $environment->getEnvContent();

        return view('vendor.installer.finished', compact('finalMessages', 'finalStatusMessage', 'finalEnvFile'));
    }
}

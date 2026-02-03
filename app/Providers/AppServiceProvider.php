<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Absensi;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

public function boot()
{
    View::composer('admin.*', function ($view) {
        $today = date('Y-m-d');

        $permohonanPending = Absensi::whereDate('tanggal', $today)
            ->whereIn('jenis', ['izin', 'sakit'])
            ->where('status_izin', 'pending')
            ->count();

        $view->with('permohonanPending', $permohonanPending);
    });
}
}

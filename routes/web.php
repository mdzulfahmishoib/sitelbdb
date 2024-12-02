<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

//Folder IT
use App\Http\Controllers\It\KendalaController;
use App\Http\Controllers\It\RekomendasiController;
use App\Http\Controllers\It\Sistem_pengembangan\SistemPengembanganController;
use App\Http\Controllers\It\Sistem_pengembangan\KategoriSistemPengembanganController;

//IT > Maintenance
use App\Http\Controllers\It\Maintenance\RegisterRuangServerController;
use App\Http\Controllers\It\Maintenance\PengecekanSuhuController;
use App\Http\Controllers\It\Maintenance\Backup\BackupController;
use App\Http\Controllers\It\Maintenance\Backup\KategoriBackupController;
use App\Http\Controllers\It\Maintenance\Evaluasi_kinerja_sistem\EvaluasiKinerjaSistemController;
use App\Http\Controllers\It\Maintenance\Evaluasi_kinerja_sistem\VendorController;
use App\Http\Controllers\It\Maintenance\Maintenance_hardware\MaintenanceHardwareController;
use App\Http\Controllers\It\Maintenance\Maintenance_hardware\KategoriMaintenanceHardwareController;
use App\Http\Controllers\It\Maintenance\Maintenance_software\MaintenanceSoftwareController;
use App\Http\Controllers\It\Maintenance\Maintenance_software\KategoriMaintenanceSoftwareController;
use App\Http\Controllers\It\Maintenance\Maintenance_server\MaintenanceServerController;
use App\Http\Controllers\It\Maintenance\Maintenance_server\KategoriMaintenanceServerController;
use App\Http\Controllers\It\Maintenance\PengecekanUnitBagianController;

//Pelaporan
use App\Http\Controllers\Pelaporan\PelaporanKeuanganController;
use App\Http\Controllers\Pelaporan\PelaporanIsidentilController;


//Informasi
use App\Http\Controllers\Informasi\KantorController;
use App\Http\Controllers\Informasi\UnitBagianController;
//Management User
use App\Http\Controllers\Management_user\PermissionController;
use App\Http\Controllers\Management_user\RoleController;
use App\Http\Controllers\Management_user\UserController;

//Layouts
use App\Http\Controllers\Layouts\ProfilController;
use App\Http\Controllers\Layouts\BerandaController;
use App\Http\Controllers\Pelaporan\Pelaporan_regulasi\PelaporanBpjsController;
use App\Http\Controllers\Pelaporan\Pelaporan_regulasi\PelaporanDirjenPajakController;
use App\Http\Controllers\Pelaporan\Pelaporan_regulasi\PelaporanDukcapilPerbarindoController;
use App\Http\Controllers\Pelaporan\Pelaporan_regulasi\PelaporanLpsController;
use App\Http\Controllers\Pelaporan\Pelaporan_regulasi\PelaporanOjkController;
use App\Http\Controllers\Pelaporan\Pelaporan_regulasi\PelaporanPemkabController;
use App\Http\Controllers\Pelaporan\Pelaporan_regulasi\PelaporanPpatkController;
use App\Http\Controllers\Produk_perusahaan\Dana\KategoriProdukDanaController;
use App\Http\Controllers\Produk_perusahaan\Dana\ProdukDanaController;
use App\Http\Controllers\Produk_perusahaan\Kredit\KategoriProdukKreditController;
use App\Http\Controllers\Produk_perusahaan\Kredit\ProdukKreditController;
use App\Http\Controllers\Produk_perusahaan\Mobile_banking\KategoriProdukMobileBankingController;
use App\Http\Controllers\Produk_perusahaan\Mobile_banking\ProdukMobileBankingController;

Route::group(['middleware' => 'auth'], function() {
    
    Route::group([], function () { //IT > Kendala
        Route::get('/kendala/data', [KendalaController::class, 'data'])->name('kendala.data');
        Route::get('kendala/clone/{id}', [KendalaController::class, 'clone'])->name('kendala.clone');
        Route::resource('it/kendala', KendalaController::class);
    });    

    Route::group([], function () { //IT > Rekomendasi
        Route::get('/rekomendasi/data', [RekomendasiController::class, 'data']) -> name('rekomendasi.data');
        Route::resource('it/rekomendasi', RekomendasiController::class);
    });  

    Route::group([], function () { //IT > Sistem Pengembangan
        Route::resource('it/sistem_pengembangan', SistemPengembanganController::class);

        Route::get('/kategori_sistem_pengembangan/data', [KategoriSistemPengembanganController::class, 'data']) -> name('kategori_sistem_pengembangan.data');
        Route::get('kategori_sistem_pengembangan/clone/{id}', [KategoriSistemPengembanganController::class, 'clone'])->name('kategori_sistem_pengembangan.clone');
        Route::resource('it/kategori_sistem_pengembangan', KategoriSistemPengembanganController::class);
    });  
    
                Route::group([], function () { //IT > Maintenance > Backup
                    Route::get('/backup/data', [BackupController::class, 'data']) -> name('backup.data');
                    Route::resource('it/maintenance/backup', BackupController::class);
                    
                    Route::get('/kategori_backup/data', [KategoriBackupController::class, 'data']) -> name('kategori_backup.data');
                    Route::get('backup/clone/{id}', [BackupController::class, 'clone'])->name('backup.clone');
                    Route::resource('it/maintenance/kategori_backup', KategoriBackupController::class);
                });  
            
                Route::group([], function () { //IT > Maintenance > Register Ruang Server
                    Route::get('/register_ruang_server/data', [RegisterRuangServerController::class, 'data']) -> name('register_ruang_server.data');
                    Route::get('register_ruang_server/clone/{id}', [RegisterRuangServerController::class, 'clone'])->name('register_ruang_server.clone');
                    Route::resource('it/maintenance/register_ruang_server', RegisterRuangServerController::class);
                });  
            
                Route::group([], function () { //IT > Maintenance > Pengecekan Unit Bagian
                        Route::get('/pengecekan_unit_bagian/data', [PengecekanUnitBagianController::class, 'data']) -> name('pengecekan_unit_bagian.data');
                        Route::resource('it/maintenance/pengecekan_unit_bagian', PengecekanUnitBagianController::class);
                });  
                    
                Route::group([], function () { //IT > Maintenance > Pengecekan Suhu
                    Route::get('/pengecekan_suhu/data', [PengecekanSuhuController::class, 'data']) -> name('pengecekan_suhu.data');
                    Route::get('pengecekan_suhu/clone/{id}', [PengecekanSuhuController::class, 'clone'])->name('pengecekan_suhu.clone');
                    Route::resource('it/maintenance/pengecekan_suhu', PengecekanSuhuController::class);
                });  
                
                Route::group([], function () { //IT > Maintenance > Evaluasi Kinerja Sistem
                    Route::get('/evaluasi_kinerja_sistem/data', [EvaluasiKinerjaSistemController::class, 'data']) -> name('evaluasi_kinerja_sistem.data');
                    Route::get('evaluasi_kinerja_sistem/clone/{id}', [EvaluasiKinerjaSistemController::class, 'clone'])->name('evaluasi_kinerja_sistem.clone');
                    Route::resource('it/maintenance/evaluasi_kinerja_sistem', EvaluasiKinerjaSistemController::class);
                    
                    Route::get('/vendor/data', [VendorController::class, 'data']) -> name('vendor.data');
                    Route::resource('it/maintenance/vendor', VendorController::class);
                });  
                
                Route::group([], function () { //IT > Maintenance > Maintenance Hardware
                    Route::get('/maintenance_hardware/data', [MaintenanceHardwareController::class, 'data']) -> name('maintenance_hardware.data');
                    Route::resource('it/maintenance/maintenance_hardware', MaintenanceHardwareController::class);
                    
                    Route::get('/kategori_maintenance_hardware/data', [KategoriMaintenanceHardwareController::class, 'data']) -> name('kategori_maintenance_hardware.data');
                    Route::resource('it/kategori_maintenance_hardware', KategoriMaintenanceHardwareController::class);
                }); 
                
                Route::group([], function () { //IT > Maintenance > Maintenance Software
                    Route::get('/maintenance_software/data', [MaintenanceSoftwareController::class, 'data']) -> name('maintenance_software.data');
                    Route::resource('it/maintenance/maintenance_software', MaintenanceSoftwareController::class);
                    
                    Route::get('/kategori_maintenance_software/data', [KategoriMaintenanceSoftwareController::class, 'data']) -> name('kategori_maintenance_software.data');
                    Route::resource('it/maintenance/kategori_maintenance_software', KategoriMaintenanceSoftwareController::class);
                }); 
                
                Route::group([], function () { //IT > Maintenance > Maintenance Server
                    Route::get('/maintenance_server/data', [MaintenanceServerController::class, 'data']) -> name('maintenance_server.data');
                    Route::resource('it/maintenance/maintenance_server', MaintenanceServerController::class);
                    
                    Route::get('/kategori_maintenance_server/data', [KategoriMaintenanceServerController::class, 'data']) -> name('kategori_maintenance_server.data');
                    Route::resource('it/kategori_maintenance_server', KategoriMaintenanceServerController::class);
                }); 

    
    Route::group([], function () { //IT > Pelaporan Keuangan
        Route::get('/pelaporan_keuangan/data', [PelaporanKeuanganController::class, 'data']) -> name('pelaporan_keuangan.data');
        Route::resource('pelaporan/pelaporan_keuangan', PelaporanKeuanganController::class);
    });  
    
    Route::group([], function () { //IT > Pelaporan Keuangan
        Route::get('/pelaporan_isidentil/data', [PelaporanIsidentilController::class, 'data']) -> name('pelaporan_isidentil.data');
        Route::resource('pelaporan/pelaporan_isidentil', PelaporanIsidentilController::class);
    }); 

    Route::group([], function () { //IT > Pelaporan Pemkab
        Route::get('/pelaporan_pemkab/data', [PelaporanPemkabController::class, 'data']) -> name('pelaporan_pemkab.data');
        Route::resource('pelaporan/pelaporan_regulasi/pelaporan_pemkab', PelaporanPemkabController::class);
    }); 

    Route::group([], function () { //IT > Pelaporan OJK
        Route::get('/pelaporan_ojk/data', [PelaporanOjkController::class, 'data']) -> name('pelaporan_ojk.data');
        Route::resource('pelaporan/pelaporan_regulasi/pelaporan_ojk', PelaporanOjkController::class);
    }); 
    
    Route::group([], function () { //IT > Pelaporan LPS
        Route::get('/pelaporan_lps/data', [PelaporanLpsController::class, 'data']) -> name('pelaporan_lps.data');
        Route::resource('pelaporan/pelaporan_regulasi/pelaporan_lps', PelaporanLpsController::class);
    }); 

    Route::group([], function () { //IT > Pelaporan PPATK
        Route::get('/pelaporan_ppatk/data', [PelaporanPpatkController::class, 'data']) -> name('pelaporan_ppatk.data');
        Route::resource('pelaporan/pelaporan_regulasi/pelaporan_ppatk', PelaporanPpatkController::class);
    }); 

    Route::group([], function () { //IT > Pelaporan Dirjen Pajak
        Route::get('/pelaporan_dirjen_pajak/data', [PelaporanDirjenPajakController::class, 'data']) -> name('pelaporan_dirjen_pajak.data');
        Route::resource('pelaporan/pelaporan_regulasi/pelaporan_dirjen_pajak', PelaporanDirjenPajakController::class);
    }); 
    
    Route::group([], function () { //IT > Pelaporan BPJS
        Route::get('/pelaporan_bpjs/data', [PelaporanBpjsController::class, 'data']) -> name('pelaporan_bpjs.data');
        Route::resource('pelaporan/pelaporan_regulasi/pelaporan_bpjs', PelaporanBpjsController::class);
    }); 
    
    Route::group([], function () { //IT > Pelaporan DUKCAPIL X PERBARINDO
        Route::get('/pelaporan_dukcapil_perbarindo/data', [PelaporanDukcapilPerbarindoController::class, 'data']) -> name('pelaporan_dukcapil_perbarindo.data');
        Route::resource('pelaporan/pelaporan_regulasi/pelaporan_dukcapil_perbarindo', PelaporanDukcapilPerbarindoController::class);
    }); 

    Route::group([], function () { //IT > Produk Perusahaan
        Route::group([], function () { //IT > Produk Perusahaan > Kredit
            Route::group([], function () { //IT > Produk Perusahaan > Kredit
                Route::get('/kredit/data', [ProdukKreditController::class, 'data']) -> name('kredit.data');
                Route::resource('produk_perusahaan/produk_kredit', ProdukKreditController::class);
            }); 

            Route::group([], function () { //IT > Produk Perusahaan > Kredit
                Route::get('/kategori_produk_kredit/data', [KategoriProdukKreditController::class, 'data']) -> name('kategori_produk_kredit.data');
                Route::get('kategori_produk_kredit/clone/{id}', [KategoriProdukKreditController::class, 'clone'])->name('kategori_produk_kredit.clone');
                Route::resource('produk_perusahaan/kategori_produk_kredit', KategoriProdukKreditController::class);
            });     
        }); 

        Route::group([], function () { //IT > Produk Perusahaan > Dana
            Route::group([], function () { //IT > Produk Perusahaan > Dana
                Route::get('/dana/data', [ProdukDanaController::class, 'data']) -> name('dana.data');
                Route::resource('produk_perusahaan/produk_dana', ProdukDanaController::class);
            }); 

            Route::group([], function () { //IT > Produk Perusahaan > Dana
                Route::get('/kategori_produk_dana/data', [KategoriProdukDanaController::class, 'data']) -> name('kategori_produk_dana.data');
                Route::get('kategori_produk_dana/clone/{id}', [KategoriProdukDanaController::class, 'clone'])->name('kategori_produk_dana.clone');
                Route::resource('produk_perusahaan/kategori_produk_dana', KategoriProdukDanaController::class);
            });     
        }); 

        Route::group([], function () { //IT > Produk Perusahaan > Mobile Banking
            Route::group([], function () { //IT > Produk Perusahaan > Mobile Banking
                Route::get('/mobile_banking/data', [ProdukMobileBankingController::class, 'data']) -> name('mobile_banking.data');
                Route::resource('produk_perusahaan/produk_mobile_banking', ProdukMobileBankingController::class);
            }); 

            Route::group([], function () { //IT > Produk Perusahaan > MobileBanking
                Route::get('/kategori_produk_mobile_banking/data', [KategoriProdukMobileBankingController::class, 'data']) -> name('kategori_produk_mobile_banking.data');
                Route::get('kategori_produk_mobile_banking/clone/{id}', [KategoriProdukMobileBankingController::class, 'clone'])->name('kategori_produk_mobile_banking.clone');
                Route::resource('produk_perusahaan/kategori_produk_mobile_banking', KategoriProdukMobileBankingController::class);
            });     
        }); 
            
    });
    
    Route::get('/informasi/tentang_sitelbdb', function () { return view('informasi.tentang_sitelbdb.index'); })->name('informasi.tentang_sitelbdb');
    Route::get('/informasi/contact_person', function () { return view('informasi.contact_person.index'); })->name('informasi.contact_person');

    Route::group([], function () { //Informasi
        Route::get('/kantor/data', [KantorController::class, 'data']) -> name('kantor.data');
        Route::resource('informasi/kantor', KantorController::class);

        Route::get('/unit_bagian/data', [UnitBagianController::class, 'data']) -> name('unit_bagian.data');
        Route::resource('informasi/unit_bagian', UnitBagianController::class);
    }); 


    Route::group([], function () { //Management User
        Route::resource('management_user/permission', PermissionController::class);
        Route::get('permission/{permissionId}/delete', [PermissionController::class, 'destroy']);
        
        Route::resource('management_user/roles', RoleController::class);
        Route::get('roles/{roleId}/delete', [RoleController::class, 'destroy']);
        Route::get('roles/{roleId}/give-permissions', [RoleController::class, 'addPermissionToRole']);
        Route::put('roles/{roleId}/give-permissions', [RoleController::class, 'givePermissionToRole']);
        
        Route::resource('management_user/users', UserController::class);
        Route::get('users/{userId}/delete', [UserController::class, 'destroy']);
        
        Route::get('management_user/profil', [ProfilController::class, 'index'])->name('layouts.profil');
        Route::put('management_user/profil', [ProfilController::class, 'updateProfile'])->name('profil.update');
    }); 
    
    Route::resource('beranda', BerandaController::class);
    Route::get('/beranda', [BerandaController::class, 'index']) -> name('beranda');

    Route::middleware(['auth'])->group(function () {
        Route::get('/beranda', [BerandaController::class, 'index'])->name('beranda');
    });

    });

Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('beranda');
    }
    return redirect()->route('login');
});

require __DIR__.'/auth.php';

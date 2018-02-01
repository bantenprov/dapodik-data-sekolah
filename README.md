# dapodik-data-sekolah
Statistik rekapitulasi data dapodik tingkat provinsi


## install via composer

- Development snapshot
```bash
$ composer require bantenprov/dapodik-data-sekolah:dev-master
```
- Latest release:

## download via github
```bash
$ git clone https://github.com/bantenprov/dapodik-data-sekolah.git
```
#### Edit `config/app.php` :
```php

'providers' => [

    /*
    * Laravel Framework Service Providers...
    */
    Illuminate\Auth\AuthServiceProvider::class,
    Illuminate\Broadcasting\BroadcastServiceProvider::class,
    Illuminate\Bus\BusServiceProvider::class,
    Illuminate\Cache\CacheServiceProvider::class,
    Illuminate\Foundation\Providers\ConsoleSupportServiceProvider::class,
    Illuminate\Cookie\CookieServiceProvider::class,
    //....
    Bantenprov\DDSekolah\DDSekolahServiceProvider::class,

```

#### Untuk publish component vue :

```bash
$ php artisan vendor:publish --tag=dd-sekolah-assets
$ php artisan vendor:publish --tag=dd-sekolah-public
```
#### Tambahkan route di dalam route : `resources/assets/js/routes.js` :

```javascript
path: '/dashboard',
component: layout('Default'),
children: [
  {
    path: '/dashboard',
    components: {
      main: resolve => require(['./components/views/DashboardHome.vue'], resolve),
      navbar: resolve => require(['./components/Navbar.vue'], resolve),
      sidebar: resolve => require(['./components/Sidebar.vue'], resolve)
    },
    meta: {
      title: "Dashboard"
    }
  },
  //== ...
  {
    path: '/dashboard/dd-sekolah',
    components: {
        main: resolve => require(['./components/views/bantenprov/dd-sekolah/DashboardDDSekolah.vue'], resolve),
        navbar: resolve => require(['./components/Navbar.vue'], resolve),
        sidebar: resolve => require(['./components/Sidebar.vue'], resolve)
    },
    meta: {
        title: "DD Sekolah"
    }
	}
```

```javascript
{
path: '/admin',
redirect: '/admin/dashboard',
component: resolve => require(['./AdminLayout.vue'], resolve),
children: [
//== ...
    {
			path: '/admin/dashboard/dd-sekolah',
			components: {
				main: resolve => require(['./components/bantenprov/dd-sekolah/DDSekolahAdmin.show.vue'], resolve),
				navbar: resolve => require(['./components/Navbar.vue'], resolve),
				sidebar: resolve => require(['./components/Sidebar.vue'], resolve)
			},
			meta: {
				title: "DD Sekolah"
			}
		}
 //== ...   
  ]
},

```
#### Edit menu `resources/assets/js/menu.js`

```javascript
{
  name: 'Dashboard',
  icon: 'fa fa-dashboard',
  childType: 'collapse',
  childItem: [
        {
          name: 'Dashboard',
          link: '/dashboard',
          icon: 'fa fa-angle-double-right'
        },
        {
          name: 'Entity',
          link: '/dashboard/entity',
          icon: 'fa fa-angle-double-right'
        },
        //== ...
        {
          name: 'Angka partisipasi kasar',
          link: '/dashboard/ap-kasar',
          icon: 'fa fa-angle-double-right'
        }
  ]
},
//== ...        
      {
        name: 'Dapodik Data Sekolah',
        link: '/dashboard/dd-sekolah',
        icon: 'fa fa-angle-double-right'
      },
```

#### Tambahkan components `resources/assets/js/components.js` :

```javascript

//== DD sekolah

import DDSekolah from './components/bantenprov/dd-sekolah/DDSekolah.chart.vue';
Vue.component('echarts-dd-sekolah', DDSekolah);

import DDSekolahKota from './components/bantenprov/dd-sekolah/DDSekolahKota.chart.vue';
Vue.component('echarts-dd-sekolah-kota', DDSekolahKota);

import DDSekolahTahun from './components/bantenprov/dd-sekolah/DDSekolahTahun.chart.vue';
Vue.component('echarts-dd-sekolah-tahun', DDSekolahTahun);

import DDSekolahAdminShow from './components/bantenprov/dd-sekolah/DDSekolahAdmin.show.vue';
Vue.component('admin-view-dd-sekolah-tahun', DDSekolahAdminShow);

//== Echarts DD Sekolah

import DDSekolahBar01 from './components/views/bantenprov/dd-sekolah/DDSekolahBar01.vue';
Vue.component('dd-sekolah-bar-01', DDSekolahBar01);

import DDSekolahBar02 from './components/views/bantenprov/dd-sekolah/DDSekolahBar02.vue';
Vue.component('dd-sekolah-bar-02', DDSekolahBar02);

//== mini bar charts
import DDSekolahBar03 from './components/views/bantenprov/dd-sekolah/DDSekolahBar03.vue';
Vue.component('dd-sekolah-bar-03', DDSekolahBar03);

import DDSekolahPie01 from './components/views/bantenprov/dd-sekolah/DDSekolahPie01.vue';
Vue.component('dd-sekolah-pie-01', DDSekolahPie01);

import DDSekolahPie02 from './components/views/bantenprov/dd-sekolah/DDSekolahPie02.vue';
Vue.component('dd-sekolah-pie-02', DDSekolahPie02);

//== mini pie charts
import DDSekolahPie03 from './components/views/bantenprov/dd-sekolah/DDSekolahPie03.vue';
Vue.component('dd-sekolah-pie-03', DDSekolahPie03);
```




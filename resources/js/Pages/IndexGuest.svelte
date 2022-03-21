<script>

    import {params} from '@/config/config.js'

    import Layout from '@/Pages/Shared/Layout.svelte'

    import Nav from '@/Pages/Shared/Nav.svelte'
    import Footer from '@/Pages/Shared/Footer.svelte'
    import Hero from '@/Pages/Components/Hero.svelte'
    import Greet from '@/Pages/Components/Greet.svelte'

    import Swal from "sweetalert2"

    export let logout

/*     let urlparams = new URLSearchParams(window.location.search);

    if ( urlparams.get('logout') ) {

        Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: 'Logout has been performed',
            showConfirmButton: false,
            timer: 1800
        })
    }  */


    if (logout) {

        Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: 'Logout has been performed',
            showConfirmButton: false,
            timer: 1800
        })

    }

</script>
  

<svelte:head>

    <title>{params.app.name} - {params.app.title}</title>

</svelte:head>

<h1>GUEST IN GORECEGI: NO LOGIN</h1>

<!-- <Nav />
<Hero />
<Greet />


<Footer /> -->

<Layout>

    <Hero />
  
  
    <Greet />
  
  </Layout>
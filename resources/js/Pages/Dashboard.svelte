<script>

    import {params} from '@/config/config.js'

    import Nav from '@/Pages/Shared/Nav.svelte'
    import Footer from '@/Pages/Shared/Footer.svelte'
    import Hero from '@/Pages/Components/Hero.svelte'
    import Greet from '@/Pages/Components/Greet.svelte'

    import Swal from "sweetalert2"

    let urlparams = new URLSearchParams(window.location.search);

    if ( urlparams.get('logout') ) {

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

<Nav />
<Hero />
<Greet />
<Footer />
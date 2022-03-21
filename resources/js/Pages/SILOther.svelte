<script>

  import { Inertia } from '@inertiajs/inertia'

  import Layout from './Shared/Layout.svelte'
  import { Link,inertia } from '@inertiajs/inertia-svelte'
  
  export let veri = "Başlangıç"

  let params = {

    foo:veri,
    bar:"bar"
  }



  function dene() {

    console.log("çalışıyor",params)

      Inertia.post('deneme', {foo:veri,bar:"bar"}, {
      // preserveState: true,
    })

    console.log("yeni veri",veri)
    //params.foo = veri

  }
  
  </script>
  

<svelte:head>

    <title>Other page title title</title>
    <meta name="description" content="Your page description" />

</svelte:head>
  
  <Layout>
  <section class="hero">
      <div class="hero-body">
        <p class="title">
          Other Page
        </p>

        <p on:click="{dene}" class="button is-link">{veri}</p>
  
        <!-- <Link href="/" class="button is-link">Go Back</Link> -->

        <!-- <Link href="deneme" method="post" data={{ foo: veri }} class="button is-link">Go to server and come back</Link> -->

        <!-- <button use:inertia={{ method: 'post', href: 'deneme',data:{ foo: veri } }} >Düğme</button> -->



      </div>
  </section>
  </Layout>
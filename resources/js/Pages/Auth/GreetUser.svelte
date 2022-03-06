<script>
  import {params} from '@/config/config.js'
  import { Link } from '@inertiajs/inertia-svelte'

  export let user

</script>

<svelte:head>
  <style>

    html {
        height:100%;
    }
    body {
        background:#e6e6e6;
        min-height:100%;
    }
  </style>
</svelte:head>


<section class="section container is-max-desktop">

    <div class="card">

        <div class="card-content">
            <p class="title has-text-centered my-4">Wellcome</p>
            <p class="subtitle has-text-centered my-4">{params.app.title}</p>
        </div>

        <div class="columns is-mobile">
            <div class="column is-half is-offset-one-quarter">
                <figure class="image">
                    <img src="/images/{params.app.app_header_logo}" alt="app main logo">
                </figure>
            </div>
        </div>

        <div class="card-content">
          <div class="content">
            <p class="mb-4">Dear {user.fullname},</p>
            <p>Your account has been successfully created.</p>
          </div>
        </div>

        <footer class="card-footer">
          <Link href="/" class="card-footer-item" as="button" preserveScroll>Main Page</Link>
          <Link href="/login" class="card-footer-item" as="button" preserveScroll>Login</Link>
        </footer>

    </div>

</section>
<script>

    import { params,gui } from '@/config/config.js'
    import { pageprops } from '@/config/config_education.js'

    import { Link } from '@inertiajs/inertia-svelte'
    import { Inertia } from '@inertiajs/inertia'

    import Layout from '@/Pages/Shared/Layout.svelte'
    import Icon from '@/Pages/Shared/Icon.svelte'
    import Header from '@/Pages/Shared/Header/Header.svelte'
    import Notification from '@/Pages/Shared/Notification/Notification.svelte'
    import ItemInfo from '@/Pages/Shared/Notification/ItemInfo.svelte'

    import Swal from "sweetalert2"

    export let item
    export let notification

    function confirmDelete(id) {

        Swal
        .fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        })
        .then((result) => {

            Inertia.delete('/education', {
                method:'delete',
                preserveState:false,
                data:{
                    id:id
                }
            })
        })
    }

</script>


<svelte:head>
  <title>{params.app.name} - Education Levels Properties</title>
</svelte:head>


  
<Layout>

    <div class="section container">

        <Header header="{{ title:pageprops.header.show }}" />

        {#if notification}
            <Notification {notification} />
        {/if}

        <div class="column has-text-right">
            <Link href="/education" class="navbar-item">
              <Icon name="list" size="{gui.icons.size}" color="{gui.icons.color}"/> Back to List
            </Link> 
        </div>


        <div class="card">
        
            <div class="card-content">
                <div class="media">
                    <div class="media-content">
                        <p class="title is-4">{item.title}</p>
                    </div>
                </div>
            
                <div class="content">{@html item.remarks}</div>
            </div>


            <footer class="card-footer">

                <a href="/education/form/{item.id}" class="card-footer-item">
                    <Icon name="edit" size="{gui.icons.size}" color="{gui.icons.color}"/>&nbsp;Edit
                </a>
                <a href="{"#"}" class="card-footer-item" on:click="{confirmDelete(item.id)}">
                    <Icon name="delete" size="{gui.icons.size}" color="danger"/>&nbsp;Delete
                </a>

            </footer>
            
        </div>

        <ItemInfo {item} />

    </div>

</Layout>
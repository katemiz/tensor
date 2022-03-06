<script>

  import {params,gui} from '@/config/config.js'
  import {pageprops,formprops,categoryprops} from '@/config/config_roles.js'

  //import { page } from '@inertiajs/inertia-svelte'

  import Layout from '@/Pages/Shared/Layout.svelte'


  import { Inertia } from '@inertiajs/inertia'
  import Pagination from '@/Pages/Shared/Pagination/Pagination.svelte'
  import Notification from '@/Pages/Shared/Notification/Notification.svelte'
  import Header from '@/Pages/Shared/Header/Header.svelte'
  import Icon from '@/Pages/Shared/Icon.svelte'


  export let roles
  export let filters
  export let notification

  // export let roles
  // export let filters
  // export let notification
  // export let selectedCategory

  let filterquery = filters.search ? filters.search:''
  let category = filters.category

  function handleQuery (category) {

    console.log("catgory and filterquery ", category,filterquery)

    if (category > 0 || filterquery.length > 2 ) {
      Inertia.get("/roles-list",{search:filterquery,category:category}, {
        preserveState:true
      })
    }

  }

  function handleReset () {
    filterquery = ''
    category= ''
    Inertia.get("/roles-list")
  }


/*   function deleteItem(event) {
    alert("deleteItem"+event.target.dataset.item)
  } */

</script>



<svelte:head>
    <title>{params.app.name} - {pageprops.headers.list}</title>
</svelte:head>




<Layout>

  <div class="section container">


  <Header header="{{ title:pageprops.headers.list }}" />

  {#if notification}
    <Notification {notification} />
  {/if}

  <!-- ***************** -->
  <!-- ADD BUTTON        -->
  <!-- ***************** -->

  <div class="column">

    <div class="buttons has-addons is-left">

      <a href="/roles/form/new" class="button is-light">
        <span class="icon is-small">
            <Icon name="add" size="{gui.icons.size}" color="{gui.icons.color}"/>
        </span>
        <span>{pageprops.commands.add.label}</span>
      </a>

    </div>
  </div>




  {#if roles.data.length > 0}

    <!-- ************************ -->
    <!-- Filter Tree Search Box   -->
    <!-- ************************ -->

    <div class="columns is-mobile">
      <div class="column is-4 is-offset-8">

        <!-- Filter Tree Search Box -->
        <div class="field has-addons is-fullwidth">

            <p class="control has-icons-left has-icons-right">
                <input class="input" type="text" placeholder="{pageprops.table.filter.placeholder}" bind:value={filterquery} on:input="{handleQuery(0)}">
                <span class="icon is-small is-left">
                    <Icon name="search" size="{gui.icons.size}" color="{gui.icons.color}"/>
                </span>
            </p>

            <div class="control">
                <button class="button is-light px-1" on:click="{handleReset}">
                    <Icon name="cancel" size="{gui.icons.size}" color="lightgrey"/>
                </button>
            </div>

        </div>
      </div>
    </div>


    <!-- ************************ -->
    <!-- TABLE                    -->
    <!-- ************************ -->

    <table class="table is-fullwidth">

      <thead>
        <tr>
          <th>Category</th>
          <th>Title</th>
          <th>Date</th>
          <th class="has-text-right">Actions</th>
        </tr>
      </thead>

      <tbody>
        {#each roles.data as item}

          <tr>
              <td><a href="{"#"}" on:click="{() =>handleQuery(item.category.id)}">{@html item.category.title_en}</a></td>
              <td><a href="/roles/{item.id}">{@html item.title_en}</a></td>
              <td>{@html item.created_at}</td>
              <td class="has-text-right">
                  <a href="/roles/{item.id}" class="icon">
                      <Icon name="eye" size="{gui.icons.size}" color="{gui.icons.color}"/>
                  </a>
                  <a href="/roles/form/{item.id}" class="icon">
                      <Icon name="edit" size="{gui.icons.size}" color="{gui.icons.color}"/>
                  </a>
                  <!-- <a href="{"#"}" class="icon" on:click="{deleteItem(item.id)}" >
                      <Icon name="delete" size="{$iconprops.size}" color="danger"/>
                  </a>                         -->
              </td>
          </tr>

        {/each}
      </tbody>

    </table>

    <Pagination pagination={roles} iconprops={gui.icons}/>

  {:else}

    <!-- ************************ -->
    <!-- NO ITEM IN DB            -->
    <!-- ************************ -->

    <div class="notification is-warning is-light">No roles found in system yet!</div>

  {/if}



<!--     <p>Roles are classified according to business categories</p>

    <div class="message-body">
      To add new role, please select category from the left menu first.
    </div> -->

  </div>

</Layout>
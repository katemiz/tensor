<script>

  import { params,gui } from '@/config/config.js'

  import { pageprops } from '@/Pages/Education/store.js'
  import { Inertia } from '@inertiajs/inertia'
  import Layout from '@/Pages/Shared/Layout.svelte'
  import Pagination from '@/Pages/Shared/Pagination/Pagination.svelte'
  import Notification from '@/Pages/Shared/Notification/Notification.svelte'
  import Header from '@/Pages/Shared/Header/Header.svelte'
  import Icon from '@/Pages/Shared/Icon.svelte'

  export let educations
  export let filters
  export let notification

  let filterquery = filters.search

  function handleQuery () {
    Inertia.get("/education",{"search":filterquery}, {
      preserveState:true
    })
  }

  function handleReset () {
    filterquery = ''
    Inertia.get("/education")
  }


/*   function deleteItem(event) {
    alert("deleteItem"+event.target.dataset.item)
  } */

</script>




<svelte:head>
  <title>{params.app.name} - List of Education Levels</title>
</svelte:head>
  
<Layout>

  <div class="section container">

    <Header header="{{ title:$pageprops.header.list }}" />

    {#if notification}
      <Notification {notification} />
    {/if}

    <!-- ***************** -->
    <!-- ADD BUTTON        -->
    <!-- ***************** -->

    <div class="column">

      <div class="buttons has-addons is-left">
  
        <a href="/education/form/new" class="button is-light">
            <span class="icon is-small">
                <Icon name="add" size="{gui.icons.size}" color="{gui.icons.color}"/>
            </span>
            <span>{$pageprops.commands.add.label}</span>
          </a>
      
      </div>
    </div>

    <!-- ************************ -->
    <!-- Filter Tree Search Box   -->
    <!-- ************************ -->

    <div class="columns is-mobile">
      <div class="column is-4 is-offset-8">

        <!-- Filter Tree Search Box -->
        <div class="field has-addons is-fullwidth">

            <p class="control has-icons-left has-icons-right">
                <input class="input" type="text" placeholder="{$pageprops.table.filter.placeholder}" bind:value={filterquery} on:input="{handleQuery}">
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


    {#if educations.data.length > 0}

      <!-- ************************ -->
      <!-- TABLE                    -->
      <!-- ************************ -->

      <table class="table is-fullwidth">

        <thead>
          <tr>
            <th>Id</th>
            <th>Education Level Title</th>
            <th>Created At</th>
            <th class="has-text-right">Actions</th>
          </tr>
        </thead>

        <tbody>
          {#each educations.data as item}

            <tr>
                <td>{item.id}</td>
                <td>{@html item.title}</td>
                <td>{@html item.created_at}</td>
                <td class="has-text-right">
                    <a href="/education/{item.id}" class="icon">
                        <Icon name="eye" size="{gui.icons.size}" color="{gui.icons.color}"/>
                    </a>
                    <a href="/education/form/{item.id}" class="icon">
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

      <Pagination pagination={educations} iconprops={gui.icons}/>

    {:else}

      <!-- ************************ -->
      <!-- NO ITEM IN DB            -->
      <!-- ************************ -->

      <div class="notification is-warning is-light">No data in system yet!</div>

    {/if}

  </div>

</Layout>
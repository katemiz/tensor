<script>
    import { params,gui } from '@/config/config.js'
    import { slevels } from '@/config/config_slevels.js'

    import { flat } from "@/Pages/Shared/Functions/tree.js";

    import Tree from '@/Pages/Shared/Tree/Tree.svelte'
    import Layout from '@/Pages/Shared/Layout.svelte'
    import Header from '@/Pages/Shared/Header/Header.svelte'
    import Icon from '@/Pages/Shared/Icon.svelte'

    import { Inertia } from '@inertiajs/inertia'

    import Swal from "sweetalert2"

    export let id
    export let skilltree
    export let roleSkills

    let currentSkillIds = []

    roleSkills.forEach( el => {
      currentSkillIds.push(parseInt(el.id))
    })

    let rawdata = flat(skilltree)

    let requirements = []
    let roleLevels = []

    console.log("roleSkills ",roleSkills)

    roleSkills.forEach(element => {

      console.log("element ",element)

      requirements[requirements.length] = rawdata.filter( el => el.id == element.id)[0]
      roleLevels[element.id] = element.pivot.level
    });


    console.log("roleLevels ",roleLevels)

    let selectedSkill

    function nodeClick(event) {

      // event.target.dataset.id is id of node clicked on tree
      selectedSkill = rawdata.filter( el => el.id == event.target.dataset.id)[0]

      if ( currentSkillIds.includes(parseInt(event.target.dataset.id)) ) {

          Swal.fire({
            position: 'center',
            icon: 'warning',
            title: 'Clicked skill is alredy included',
            showConfirmButton: false,
            timer: 1000
          })
      } else {
        requirements[requirements.length] = selectedSkill;
        currentSkillIds.push(parseInt(event.target.dataset.id))
      }
    }

    function addClick() {
      alert("addClick clicked")
    }


    function removeSkill(deger) {

      currentSkillIds = currentSkillIds.filter(function(e) { return e !== deger })

      delete currentSkillIds[deger]

      requirements = requirements.filter(function(e) { return e.id !== deger })
    }

    function save () {

      let skills = []

      roleLevels.forEach( (value,key) => {

        if (value !== undefined && value !== null) {

          if (value === 'NotSelected') {
            value = null
          }
          skills.push({skill:key,level:value})
        }
        console.log("****** ", key,value)
      })

      Inertia.post('/role-skill', {id:id,skills: skills},{
        preserveState:false
      })

      //console.log("save roleSkills ",roleSkills)
      console.log("save roleLevels ",roleLevels)





    }


    const treeprops = {

      titleColumn:"title_en",
      expanded:false,
      title:"Skill",
      boxTitle:"My Tree",
      home:"My First Node title",
      filter_placeholder:"Search in tree ...",

      commands:{
        add:false
      }
    }



</script>
        
  
<svelte:head>
    <title>{params.app.name} - Required Skills and Skill Levels</title>
</svelte:head>
    
<Layout>

  <section class="section container">

      <Header header="{{ title:'Required Skills',subtitle:'Skill Level Requirements',isdefault:true }}" />

      <div class="buttons is-pulled-right">
        <button class="button is-info" on:click="{save}">Save</button>
        <a href="/roles/{id}" class="button is-danger">Cancel</a>
      </div>

      {#if requirements.length > 0}

      <table class="table is-bordered is-striped is-fullwidth">

        <thead>
          <tr>
            <th>&nbsp;</th>
            <th>Required Skill</th>
            <th>Required Skill Level</th>
          </tr>
        </thead>

        <tbody>

          {#each requirements as requirement}
          <tr>
            <td>
              <a href="{"#"}" class="icon" on:click={removeSkill(requirement.id)}>
                <Icon name="remove_from_list" size="{gui.icons.size}" color="danger"/>
              </a>
            </td>
            <td>{requirement.id} {requirement.title_en}</td>
            <td>
              
              <div class="field">

                <div class="control">
    
                    <div class="select is-fullwidth">
                        <select bind:value={roleLevels[requirement.id]}>
                            <option value="0">Select ...</option>
    
                            {#each slevels as level}
                                <option value="{level.level}">{level.level} - {level.title}</option>
                            {/each}
                        </select>
                    </div>
    
                </div>
              </div>
              
            </td>
          </tr>
          {/each}

        </tbody>

      </table>
      {:else}

        <div class="notification is-warning">
          No skill requirements has been defined for this role yet.<br>
        </div>

      {/if}


      <div class="notification is-info is-light">
        Please select skills from the lower tree to add skill requirements.
      </div>

      <Tree treeprops={treeprops} treedata={skilltree} iconprops={gui.icons} {nodeClick} {addClick}/>

  
  </section>

</Layout>
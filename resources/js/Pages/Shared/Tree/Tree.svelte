<script>

	import Node from "@/Pages/Shared/Tree/Node.svelte";
	import Icon from '@/Pages/Shared/Icon.svelte'

    export let treeprops
	export let iconprops
	export let treedata
	export let nodeClick
	export let addClick

	let defaultState = treeprops.expanded

	let query

	let dataBackup = treedata


	function showHideTree () {
		treedata = toggleTree(treedata)
		treeprops.expanded = !treeprops.expanded
	}



    /**
    * Function that toggles visibility of tree - all branches visible/hidden
    */

	function toggleTree(dizin) {

		dizin.forEach( (el) => {

			if (el.children.length > 0) {
				el.expanded = !el.expanded
				toggleTree(el.children)
			}
		})

		return dizin
	}


	function findInTree() {

		if (query.length > 2 ) {
			treedata = 	filterTree(dataBackup, query)
		} else {
			treedata = dataBackup
		}
	}


	function filterTree(array, query) {

		const getNodes = (result, object) => {

			object.expanded = true

			if ( object[treeprops.titleColumn].toLowerCase().includes(query.toLowerCase()) ) {
				result.push(object);
				return result;
			}
			
			if (Array.isArray(object.children)) {
				const children = object.children.reduce(getNodes, []);
				if (children.length) result.push({ ...object, children });
			}
			return result;
		};

		return array.reduce(getNodes, []);
	}


	function handleReset () {
		query=''
		treeprops.expanded = defaultState
		treedata = dataBackup
	}

</script>






{#if treeprops.commands.add}

<div class="column px-0">

    <div class="buttons has-addons is-right">

        <button class="button is-light">
            <span class="icon is-small">
                <Icon name="add" size="{iconprops.size}" color="{iconprops.color}"/>
            </span>
            <span on:click={addClick}>{treeprops.commands.add.label}</span>
        </button>
    
    </div>
    
</div>

{/if}







{#if treedata.length > 0}

	<div class="column px-0">

		<!-- Filter Tree Search Box -->
		<div class="field has-addons is-fullwidth">

			<p class="control has-icons-left has-icons-right">
				<input class="input" type="text" placeholder="{treeprops.filter_placeholder}" bind:value={query} on:input="{findInTree}">
				<span class="icon is-small is-left">
					<Icon name="search" size="{iconprops.size}" color="{iconprops.color}"/>
				</span>
			</p>

			<div class="control">
				<button class="button is-light px-1" on:click="{handleReset}">
					<Icon name="cancel" size="{iconprops.size}" color="lightgrey"/>
				</button>
			</div>

		</div>

	</div>

	<!-- TREE -->
	<div class="box">

		<!-- TITLE AND EXPAND/COLLAPSE BUTTONS -->
		<div class="top-node icon-text menu-label has-text-info-dark">
			<span class="icon-text">
				<span class="icon">

					<button class="button is-light is-small" class:is-hidden="{!treeprops.expanded}" on:click="{showHideTree}">
						<span class="icon is-small">
							<Icon name="compress" size="{iconprops.size}" color="{iconprops.color}"/>
						</span>
					</button>
				
					<button class="button is-light is-small" class:is-hidden="{treeprops.expanded}" on:click="{showHideTree}">
						<span class="icon is-small">
							<Icon name="expand" size="{iconprops.size}" color="{iconprops.color}"/>
						</span>
					</button>

				</span>
				<span>{treeprops.title}</span>
			</span>
		</div>

		<ul>
			{#each treedata as node}
				<Node bind:node={node} {treeprops} {nodeClick} />	
			{/each}
		</ul>

	</div>

{:else}
	<div class="notification is-warning">
	Nothing yet for {treeprops.title}.
	</div>
{/if}
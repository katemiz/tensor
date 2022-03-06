<script>
    import Icon from '../Icon.svelte'
    export let treeprops
    export let iconprops
    export let addClick
</script>


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
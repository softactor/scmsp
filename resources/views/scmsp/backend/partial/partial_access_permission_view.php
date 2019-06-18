<div class="row">
    <div class="col-md-3"><h5>All Modules</h5></div>
    <div class="col-md-1"> :</div>
    <div class="col-md-8">
        <h3>
            <input type="checkbox" name="isallpermission" id="isallpermission" class="minimal" onchange="allcheck()" value="1">
        </h3>
    </div>
</div>
<!-- checkbox -->
<?php
$modules = get_table_data_by_table('modules');
if (isset($modules) && !empty($modules)) {
    foreach ($modules as $module) {
        ?>
        <div class="form-group"> 
            <div class="row">
                <div class="col-md-3"><?php echo $module->name ?></div>
                <div class="col-md-1"> :</div>
                <div class="col-md-8"> 
                    <label>
                        <input type="checkbox" name="module[<?php echo $module->id ?>][add]" class="minimal module_common_class <?php echo 'module_type_' . $module->id; ?>" value="1" <?php if(isset($pertialAccessCheck[$module->name]) && $pertialAccessCheck[$module->name]['addaccess']==1 || isset($pertialAccessCheck[$module->name]) && $pertialAccessCheck[$module->name]['isallmodulepermission']==1){ echo 'checked'; } ?>>
                        Add 
                    </label>
                    <label>
                        <input type="checkbox" name="module[<?php echo $module->id ?>][edit]" class="minimal module_common_class <?php echo 'module_type_' . $module->id; ?>" value="1" <?php if(isset($pertialAccessCheck[$module->name]) && $pertialAccessCheck[$module->name]['editaccess']==1 || isset($pertialAccessCheck[$module->name]) && $pertialAccessCheck[$module->name]['isallmodulepermission']==1){ echo 'checked'; } ?>>
                        Edit 
                    </label>
                    <label>
                        <input type="checkbox" name="module[<?php echo $module->id ?>][list]" class="minimal module_common_class <?php echo 'module_type_' . $module->id; ?>" value="1" <?php if(isset($pertialAccessCheck[$module->name]) && $pertialAccessCheck[$module->name]['listaccess']==1 || isset($pertialAccessCheck[$module->name]) && $pertialAccessCheck[$module->name]['isallmodulepermission']==1){ echo 'checked'; } ?>>
                        List 
                    </label>
                    <label>
                        <input type="checkbox" name="module[<?php echo $module->id ?>][del]" class="minimal module_common_class <?php echo 'module_type_' . $module->id; ?>" value="1" <?php if(isset($pertialAccessCheck[$module->name]) && $pertialAccessCheck[$module->name]['deleteaccess']==1 || isset($pertialAccessCheck[$module->name]) && $pertialAccessCheck[$module->name]['isallmodulepermission']==1){ echo 'checked'; } ?>>
                        Delete 
                    </label>
                    <label>
                        <input type="checkbox" id="ind_module_all_selector_<?php echo $module->id; ?>" name="module[<?php echo $module->id ?>][all]" class="minimal module_common_class" value="1" onclick="toggleIndividualModuleChecked('<?php echo $module->id; ?>');" <?php if(isset($pertialAccessCheck[$module->name]) && $pertialAccessCheck[$module->name]['isallmodulepermission']==1){ echo 'checked'; } ?>>
                        All 
                    </label>
                </div>
            </div>
        </div>
<?php } } ?>
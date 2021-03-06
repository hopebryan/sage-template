<?php

/*
    "Contact Form to Database" Copyright (C) 2011-2016 Michael Simpson  (email : michael.d.simpson@gmail.com)

    This file is part of Contact Form to Database.

    Contact Form to Database is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    Contact Form to Database is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with Contact Form to Database.
    If not, see <http://www.gnu.org/licenses/>.
*/

class CFDBViewOptions {

    /**
     * @var CF7DBPlugin
     */
    var $plugin;

    /**
     * CFDBViewOptions constructor.
     * @param CF7DBPlugin $plugin
     */
    public function __construct(CF7DBPlugin $plugin) {
        $this->plugin = $plugin;
    }

    public function enqueueSettingsPageScripts() {
        wp_enqueue_style('jquery-ui', plugins_url('/css/jquery-ui.css', __FILE__));
        wp_enqueue_script('jquery');
        wp_enqueue_script('jquery-ui-core', array('jquery'));
        wp_enqueue_script('jquery-ui-tabs', array('jquery'));
    }

    public function outputOptions() {
        $this->outputHeader();
        ?>

        <script type="text/javascript">
            jQuery(function () {
                jQuery("#cfdb_options_tabs").tabs();
            });
        </script>
        <div class="cfdb_options_div">
            <div id="cfdb_options_tabs">
                <ul>
                    <li>
                        <a href="#cfdb_config-1"><?php _e('Integrations', 'contact-form-7-to-database-extension'); ?></a>
                    </li>
                    <li>
                        <a href="#cfdb_config-2"><?php _e('Security', 'contact-form-7-to-database-extension'); ?></a>
                    </li>
                    <li>
                        <a href="#cfdb_config-3"><?php _e('Saving', 'contact-form-7-to-database-extension'); ?></a>
                    </li>
                    <li>
                        <a href="#cfdb_config-4"><?php _e('Export', 'contact-form-7-to-database-extension'); ?></a>
                    </li>
                    <li>
                        <a href="#cfdb_config-5"><?php _e('Admin View', 'contact-form-7-to-database-extension'); ?></a>
                    </li>
                    <li>
                        <a href="#cfdb_config-10"><?php _e('System', 'contact-form-7-to-database-extension'); ?></a>
                    </li>
                </ul>
                <div id="cfdb_config-1">
                    <?php
                    $filter = function ($name) {
                        return strpos($name, 'IntegrateWith') === 0 || $name == 'GenerateSubmitTimeInCF7Email';
                    };
                    $this->outputSettings($filter);
                    ?>
                </div>
                <div id="cfdb_config-2">
                    <?php
                    $filter = function ($name) {
                        return in_array($name, array(
                                'CanSeeSubmitData', 'CanSeeSubmitDataViaShortcode', 'CanChangeSubmitData',
                                'FunctionsInShortCodes', 'HideAdminPanelFromNonAdmins', 'AllowRSS'));
                    };
                    $this->outputSettings($filter);
                    ?>
                </div>
                <div id="cfdb_config-3">
                    <?php
                    $filter = function ($name) {
                        return in_array($name, array(
                                'Timezone', 'NoSaveFields', 'NoSaveForms',
                                'SaveCookieData', 'SaveCookieNames'));
                    };
                    $this->outputSettings($filter);
                    ?>
                </div>
                <div id="cfdb_config-4">
                    <?php
                    $filter = function ($name) {
                        return in_array($name, array(
                                'SubmitDateTimeFormat', 'UseCustomDateTimeFormat', 'ShowFileUrlsInExport'));
                    };
                    $this->outputSettings($filter);
                    ?>
                </div>
                <div id="cfdb_config-5">
                    <?php
                    $filter = function ($name) {
                        return in_array($name, array(
                                'MaxRows', 'MaxVisibleRows', 'HorizontalScroll', 'UseDataTablesJS',
                                'ShowLineBreaksInDataTable', 'ShowQuery'));
                    };
                    $this->outputSettings($filter);
                    ?>
                </div>
                <div id="cfdb_config-10">
                    <?php $this->outputSystemSettings();
                    $filter = function ($name) {
                        return in_array($name, array(
                                'ErrorOutput', 'DropOnUninstall', '_version'));
                    };
                    $this->outputSettings($filter);
                    ?>
                </div>
            </div>

        </div>
        <?php
        $this->outputFooter();
    }

public function outputHeader() {
    ?>
    <div>
        <style type="text/css">
            table.cfdb-options-table {
                width: 100%
            }

            table.cfdb-options-table tr:nth-child(even) {
                background: #f9f9f9
            }

            table.cfdb-options-table tr:nth-child(odd) {
                background: #FFF
            }

            table.cfdb-options-table td:first-child {
                width: 350px;
            }

            table.cfdb-options-table td p {
                margin-bottom: 0;
                margin-top: 0;
                padding-right: 4px
            }
        </style>
        <h2><img src="<?php echo $this->plugin->getPluginFileUrl('img/icon-50x50.png') ?>" alt=""/>
            <?php echo htmlspecialchars(__('Settings', 'contact-form-7-to-database-extension')); ?></h2>
        <form method="post" action="">
            <p class="submit">
                <input type="submit" class="button-primary"
                       value="<?php echo htmlspecialchars(__('Save Changes', 'contact-form-7-to-database-extension')); ?>"/>
            </p>

            <?php
            $settingsGroup = get_class($this) . '-settings-group';
            settings_fields($settingsGroup);
            }

            public function outputFooter() {
            ?>
        </form>
    </div>
    <?php
}

    public function outputSystemSettings() {
        ?>
        <table class="cfdb-options-table">
            <tbody>
            <?php
            if (function_exists('php_uname')) {
                try { ?>
                    <tr>
                        <td><?php echo htmlspecialchars(__('System', 'contact-form-7-to-database-extension')); ?></td>
                        <td><?php echo php_uname(); ?></td>
                    </tr>
                    <?php
                } catch (Exception $ex) {
                }
            } ?>
            <tr>
                <td><?php echo htmlspecialchars(__('PHP Version', 'contact-form-7-to-database-extension')); ?></td>
                <td><?php echo phpversion(); ?>
                    <?php
                    if (version_compare('5.2', phpversion()) > 0) {
                        echo '&nbsp;&nbsp;&nbsp;<span style="background-color: #ffcc00;">';
                        echo htmlspecialchars(__('(WARNING: This plugin may not work properly with versions earlier than PHP 5.2)', 'contact-form-7-to-database-extension'));
                        echo '</span>';
                    }
                    ?>
                </td>
            </tr>
            <tr>
                <td><?php echo htmlspecialchars(__('MySQL Version', 'contact-form-7-to-database-extension')); ?></td>
                <td><?php echo $this->plugin->getMySqlVersion() ?>
                    <?php
                    echo '&nbsp;&nbsp;&nbsp;<span style="background-color: #ffcc00;">';
                    if (version_compare('5.0', $this->plugin->getMySqlVersion()) > 0) {
                        echo htmlspecialchars(__('(WARNING: This plugin may not work properly with versions earlier than MySQL 5.0)', 'contact-form-7-to-database-extension'));
                    }
                    echo '</span>';
                    ?>
                </td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            </tbody>
        </table>
        <?php
    }


    public function outputSettings($filterFunction) {
        $optionMetaData = $this->plugin->getOptionMetaData();
        if ($optionMetaData == null) {
            return;
        }

        ?>
        <table class="cfdb-options-table">
            <tbody>
            <?php
            foreach ($optionMetaData as $aOptionKey => $aOptionMeta) {
                if ($filterFunction($aOptionKey)) {
                    $displayText = is_array($aOptionMeta) ? $aOptionMeta[0] : $aOptionMeta;
                    $displayText = __($displayText, 'contact-form-7-to-database-extension');
                    ?>
                    <tr valign="top">
                        <td><p><label for="<?php echo $aOptionKey ?>"><?php echo $displayText ?></label></p></td>
                        <td>
                            <?php $this->plugin->createFormControl($aOptionKey, $aOptionMeta, $this->plugin->getOption($aOptionKey)); ?>
                        </td>
                    </tr>
                    <?php
                }
            }
            ?>
            </tbody>
        </table>

        <?php

    }

}


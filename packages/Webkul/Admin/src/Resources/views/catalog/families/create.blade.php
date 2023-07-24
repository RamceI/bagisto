<x-admin::layouts>
    {{-- Input Form --}}
    <x-admin::form :action="route('admin.catalog.families.store')">
        {{-- Page Header --}}
        <div class="flex justify-between items-center">
            <p class="text-[20px] text-gray-800 font-bold">
                @lang('admin::app.catalog.families.create.title')
            </p>

            <div class="flex gap-x-[10px] items-center">
                <a href="{{ route('admin.catalog.families.index') }}">
                    <span class="text-gray-600 font-semibold whitespace-nowrap px-[12px] py-[6px] border-[2px] border-transparent rounded-[6px] transition-all hover:bg-gray-100 cursor-pointer">
                        @lang('admin::app.catalog.families.create.cancel-btn')
                    </span>
                </a>

                <button 
                    type="submit" 
                    class="text-gray-50 font-semibold px-[12px] py-[6px] bg-blue-600 border border-blue-700 rounded-[6px] cursor-pointer"
                >
                    @lang('admin::app.catalog.families.create.save-btn')
                </button>
            </div>
        </div>

        {{-- Container --}}
        <div class="flex gap-[10px] mt-[14px]">
            {{-- Left Container --}}
            <div class="flex flex-col gap-[8px] flex-1 bg-white box-shadow">
                <v-testing></v-testing>
            </div>

            {{-- Right Container --}}
            <div class="flex flex-col gap-[8px] w-[360px] max-w-full">
                {{-- General Pannel --}}
                <div class="bg-white rounded-[4px] box-shadow">
                    {{-- Settings --}}
                    <x-admin::accordion>
                        {{-- Panel Header --}}
                        <x-slot:header>
                            <p class="p-[10px] text-gray-600 text-[16px] font-semibold">
                                @lang('admin::app.catalog.families.create.general')
                            </p>
                        </x-slot:header>
                    
                        {{-- Panel Content --}}
                        <x-slot:content>
                            <x-admin::form.control-group class="mb-4">
                                <x-admin::form.control-group.label class="!text-gray-800">
                                    @lang('admin::app.catalog.families.create.code')
                                </x-admin::form.control-group.label>

                                <x-admin::form.control-group.control
                                    type="text"
                                    name="code"
                                    class="!w-[284px]"
                                    value="{{ old('code') }}"
                                    rules="required"
                                    :label="trans('admin::app.catalog.families.create.code')"
                                    :placeholder="trans('admin::app.catalog.families.create.enter-code')"
                                >
                                </x-admin::form.control-group.control>

                                <x-admin::form.control-group.error
                                    control-name="code"
                                >
                                </x-admin::form.control-group.error>
                            </x-admin::form.control-group>

                            <x-admin::form.control-group class="mb-4">
                                <x-admin::form.control-group.label class="!text-gray-800">
                                    @lang('admin::app.catalog.families.create.name')
                                </x-admin::form.control-group.label>

                                <x-admin::form.control-group.control
                                    type="text"
                                    name="name"
                                    class="!w-[284px]"
                                    value="{{ old('name') }}"
                                    rules="required"
                                    :label="trans('admin::app.catalog.families.create.name')"
                                    :placeholder="trans('admin::app.catalog.families.create.enter-name')"
                                >
                                </x-admin::form.control-group.control>

                                <x-admin::form.control-group.error
                                    control-name="name"
                                >
                                </x-admin::form.control-group.error>
                            </x-admin::form.control-group>
                        </x-slot:content>
                    </x-admin::accordion>
                </div>
            </div>
        </div>
    </x-admin::form>


    @pushOnce('scripts')
        <script type="text/x-template" id="v-testing-template">
            <div class="">
                <!-- Panel Header -->
                <div class="flex gap-[10px] justify-between flex-wrap mb-[10px] p-[16px]">
                    <!-- Panel Header -->
                    <div class="flex flex-col gap-[8px]">
                        <p class="text-[16px] text-gray-800 font-semibold">
                            @lang('admin::app.catalog.families.create.groups')
                        </p>

                        <p class="text-[12px] text-gray-500 font-medium">
                            @lang('admin::app.catalog.families.create.groups-info')
                        </p>
                    </div>
                    
                    <!-- Panel Content -->
                    <div class="flex gap-x-[4px] items-center">
                        <!-- Delete Group Button -->
                        <div
                            class="px-[12px] py-[5px] border-[2px] border-transparent rounded-[6px] text-red-600 font-semibold whitespace-nowrap transition-all hover:bg-gray-100 cursor-pointer"
                            @click="deleteGroup"
                        >
                            @lang('admin::app.catalog.families.create.delete-group-btn')
                        </div>

                        <!-- Add Group Button -->
                        <div
                            class="px-[12px] py-[5px] bg-white border-[2px] border-blue-600 rounded-[6px] text-blue-600 font-semibold whitespace-nowrap cursor-pointer"
                            @click="$refs.addGroupModal.toggle()"
                        >
                            @lang('admin::app.catalog.families.create.add-group-btn')
                        </div>
                    </div>
                </div>

                <!-- Panel Content -->
                <div class="flex [&>*]:flex-1 gap-[20px] justify-between px-[16px]">
                    <!-- Attributes Groups Container -->
                    <div v-for="(groups, column) in columnGroups">
                        <!-- Attributes Groups Header -->
                        <div class="flex flex-col mb-[16px]">
                            <p class="text-gray-600 font-semibold leading-[24px]">
                                @{{
                                    column == 1
                                    ? "@lang('admin::app.catalog.families.create.main-column')"
                                    : "@lang('admin::app.catalog.families.create.right-column')"
                                }}
                            </p>
                            
                            <p class="text-[12px] text-gray-800 font-medium">
                                @lang('admin::app.catalog.families.create.edit-group-info')
                            </p>
                        </div>

                        <!-- Draggable Attribute Groups -->
                        <draggable
                            class="h-[calc(100vh-285px)] pb-[16px] overflow-auto border-r-[1px] border-gray-200"
                            ghost-class="draggable-ghost"
                            :list="groups"
                            item-key="id"
                            group="groups"
                        >
                            <template #item="{ element, index }">
                                <div class="">
                                    <!-- Group Container -->
                                    <div class="flex items-center">
                                        <!-- Toggle -->
                                        <i
                                            class="icon-sort-down text-[20px] rounded-[6px] cursor-pointer transition-all hover:bg-gray-100"
                                            @click="element.hide = ! element.hide"
                                        ></i>

                                        <!-- Group Name -->
                                        <div
                                            class="group_node flex gap-[6px] max-w-max py-[6px] pr-[6px] rounded-[4px] text-gray-600 group cursor-pointer"
                                            :class="{'bg-blue-600 text-white group-hover:text-white': selectedGroup.id == element.id}"
                                            @click="groupSelected(element)"
                                        >
                                            <i class="icon-drag text-[20px] text-inherit transition-all pointer-events-none"></i>

                                            <i
                                                class="text-[20px] text-inherit transition-all pointer-events-none"
                                                :class="[element.is_user_defined ? 'icon-attribute' : 'icon-attribute-block']"
                                            ></i>

                                            <span
                                                class="text-[14px] text-inherit font-regular transition-all pointer-events-none"
                                                v-show="editableGroup.id != element.id"
                                            >
                                                @{{ element.name }}
                                            </span>

                                            <input
                                                type="text"
                                                :name="'attribute_groups[' + element.id + '][name]'"
                                                class="group_node text-[14px] text-gray-600"
                                                v-model="element.name"
                                                v-show="editableGroup.id == element.id"
                                            />

                                            <input
                                                type="hidden"
                                                :name="'attribute_groups[' + element.id + '][position]'"
                                                class="group_node text-[14px] text-gray-600"
                                                :value="index + 1"
                                            />

                                            <input
                                                type="hidden"
                                                :name="'attribute_groups[' + element.id + '][column]'"
                                                class="group_node text-[14px] text-gray-600"
                                                :value="column"
                                            />
                                        </div>
                                    </div>

                                    <!-- Group Attributes -->
                                    <draggable
                                        class="ml-[43px]"
                                        ghost-class="draggable-ghost"
                                        :list="getGroupAttributes(element)"
                                        item-key="id"
                                        group="attributes"
                                        :move="onMove"
                                        @end="onEnd"
                                        v-show="! element.hide"
                                    >
                                        <template #item="{ element, index }">
                                            <div class="flex gap-[6px] max-w-max py-[6px] pr-[6px] rounded-[4px] text-gray-600 group cursor-pointer">
                                                <i class="icon-drag text-[20px] transition-all group-hover:text-gray-700"></i>

                                                <i
                                                    class="text-[20px] transition-all group-hover:text-gray-700"
                                                    :class="[element.is_user_defined ? 'icon-attribute' : 'icon-attribute-block']"
                                                ></i>
                                                

                                                <span class="text-[14px] font-regular transition-all group-hover:text-gray-800 max-xl:text-[12px]">
                                                    @{{ element.admin_name }}
                                                </span>

                                                <input
                                                    type="hidden"
                                                    :name="'attribute_groups[' + element.group_id + '][custom_attributes][' + index + '][id]'"
                                                    class="text-[14px] text-gray-600"
                                                    v-model="element.id"
                                                />

                                                <input
                                                    type="hidden"
                                                    :name="'attribute_groups[' + element.group_id + '][custom_attributes][' + index + '][position]'"
                                                    class="text-[14px] text-gray-600"
                                                    :value="index + 1"
                                                />
                                            </div>
                                        </template>
                                    </draggable>
                                </div>
                            </template>
                        </draggable>
                    </div>

                    <!-- Unassigned Attributes Container -->
                    <div class="">
                        <!-- Unassigned Attributes Header -->
                        <div class="flex flex-col mb-[16px]">
                            <p class="text-gray-600 font-semibold leading-[24px]">
                                Unassigned Attribues

                                @lang('admin::app.catalog.families.create.unassigned-attributes')
                            </p>

                            <p class="text-[12px] text-gray-800 font-medium ">
                                @lang('admin::app.catalog.families.create.unassigned-attributes-info')
                            </p>
                        </div>

                        <!-- Draggable Unassigned Attributes -->
                        <draggable
                            id="unassigned-attributes"
                            class="h-[calc(100vh-285px)] pb-[16px] overflow-auto"
                            ghost-class="draggable-ghost"
                            :list="unassignedAttributes"
                            item-key="id"
                            group="attributes"
                        >
                            <template #item="{ element }">
                                <div class="flex gap-[6px] max-w-max py-[6px] pr-[6px] rounded-[4px] text-gray-600 group cursor-pointer">
                                    <i class="icon-drag text-[20px] transition-all group-hover:text-gray-700"></i>

                                    <i
                                        class="text-[20px] transition-all group-hover:text-gray-700"
                                        :class="[element.is_user_defined ? 'icon-attribute' : 'icon-attribute-block']"
                                    ></i>
                                    

                                    <span class="text-[14px] font-regular transition-all group-hover:text-gray-800 max-xl:text-[12px]">
                                        @{{ element.admin_name }}
                                    </span>
                                </div>
                            </template>
                        </draggable>
                    </div>
                </div>

                <x-admin::form
                    v-slot="{ meta, errors, handleSubmit }"
                    as="div"
                >
                    <form @submit="handleSubmit($event, addGroup)">
                        <x-admin::modal ref="addGroupModal">
                            <x-slot:header>
                                <p class="text-[18px] text-gray-800 font-bold">
                                    @lang('admin::app.catalog.families.create.add-group-title')
                                </p>
                            </x-slot:header>

                            <x-slot:content>
                                <div class="px-[16px] py-[10px] border-b-[1px] border-gray-300">
                                    <x-admin::form.control-group class="mb-[10px]">
                                        <x-admin::form.control-group.label>
                                            @lang('admin::app.catalog.families.create.name')
                                        </x-admin::form.control-group.label>

                                        <x-admin::form.control-group.control
                                            type="text"
                                            name="name"
                                            rules="required"
                                            :label="trans('admin::app.catalog.families.create.name')"
                                            :placeholder="trans('admin::app.catalog.families.create.name')"
                                        >
                                        </x-admin::form.control-group.control>

                                        <x-admin::form.control-group.error control-name="name"></x-admin::form.control-group.error>
                                    </x-admin::form.control-group>

                                    <x-admin::form.control-group class="mb-4">
                                        <x-admin::form.control-group.label class="!text-gray-800 font-medium">
                                            @lang('admin::app.catalog.families.create.column')
                                        </x-admin::form.control-group.label>

                                        <x-admin::form.control-group.control
                                            type="select"
                                            name="column"
                                            rules="required"
                                            :label="trans('admin::app.catalog.families.create.column')"
                                        >
                                            <option value="1">
                                                @lang('admin::app.catalog.families.create.main-column')
                                            </option>

                                            <option value="2">
                                                @lang('admin::app.catalog.families.create.right-column')
                                            </option>
                                        </x-admin::form.control-group.control>

                                        <x-admin::form.control-group.error control-name="column"></x-admin::form.control-group.error>
                                    </x-admin::form.control-group>
                                </div>
                            </x-slot:content>

                            <x-slot:footer>
                                <div class="flex gap-x-[10px] items-center">
                                    <button 
                                        type="submit"
                                        class="px-[12px] py-[6px] bg-blue-600 border border-blue-700 rounded-[6px] text-gray-50 font-semibold cursor-pointer"
                                    >
                                        @lang('admin::app.catalog.families.create.add-group-btn')
                                    </button>
                                </div>
                            </x-slot:footer>
                        </x-admin::modal>
                    </form>
                </x-admin::form>
            </div>
        </script>

        <script type="module">
            app.component('v-testing', {
                template: '#v-testing-template',

                data: function () {
                    return {
                        selectedGroup: {
                            id: null,
                            name: null,
                        },

                        editableGroup: {
                            id: null,
                            name: null,
                        },

                        columnGroups: @json($attributeFamily->attribute_groups->groupBy('column')),

                        customAttributes: @json($customAttributes),

                        dropReverted: false,
                    }
                },

                created() {
                    window.addEventListener('click', this.handleFocusOut);
                },

                computed: {
                    unassignedAttributes() {
                        return this.customAttributes.filter(attribute => {
                            return ! this.columnGroups[1].find(group => group.custom_attributes.find(customAttribute => customAttribute.id == attribute.id))
                                && ! this.columnGroups[2].find(group => group.custom_attributes.find(customAttribute => customAttribute.id == attribute.id));
                        });
                    },
                },

                methods: {
                    onMove: function(e) {
                        if (
                            e.to.id === 'unassigned-attributes'
                            && ! e.draggedContext.element.is_user_defined
                        ) {
                            this.dropReverted = true;

                            return false;
                        } else {
                            this.dropReverted = false;
                        }
                    },

                    onEnd: function(e) {
                        if (this.dropReverted) {
                            this.$emitter.emit('add-flash', { type: 'warning', message: "{{ trans('admin::app.catalog.families.create.removal-not-possible') }}" });
                        }
                    },

                    getGroupAttributes(group) {
                        group.custom_attributes.forEach((attribute, index) => {
                            attribute.group_id = group.id;
                        });

                        return group.custom_attributes;
                    },

                    groupSelected(group) {
                        if (this.selectedGroup.id) {
                            this.editableGroup = this.selectedGroup.id == group.id
                                ? group
                                : {
                                    id: null,
                                    name: null,
                                };
                        }

                        this.selectedGroup = group;
                    },

                    addGroup(params, { resetForm, setErrors }) {
                        if (this.isGroupAlreadyExists(params.name)) {
                            setErrors({'name': ["{{ trans('admin::app.catalog.families.create.group-already-exists') }}"]});

                            return;
                        }

                        this.columnGroups[params.column].push({
                            'id': 'group_' + params.column + '_' + this.columnGroups[params.column].length,
                            'name': params.name,
                            'is_user_defined': 1,
                            'custom_attributes': [],
                        });

                        resetForm();

                        this.$refs.addGroupModal.toggle();
                    },
                    
                    isGroupAlreadyExists(name) {
                        return this.columnGroups[1].find(group => group.name == name) || this.columnGroups[2].find(group => group.name == name);
                    },
                    
                    isGroupContainsSystemAttributes(group) {
                        return group.custom_attributes.find(attribute => ! attribute.is_user_defined);
                    },

                    deleteGroup() {
                        if (! this.selectedGroup.id) {
                            this.$emitter.emit('add-flash', { type: 'warning', message: "{{ trans('admin::app.catalog.families.create.select-group') }}" });

                            return;
                        }

                        if (this.isGroupContainsSystemAttributes(this.selectedGroup)) {
                            this.$emitter.emit('add-flash', { type: 'warning', message: "{{ trans('admin::app.catalog.families.create.group-contains-system-attributes') }}" });

                            return;
                        }

                        for (const [key, groups] of Object.entries(this.columnGroups)) {
                            let index = groups.indexOf(this.selectedGroup);

                            if (index > -1) {
                                groups.splice(index, 1);
                            }
                        }
                    },

                    handleFocusOut(e) {
                        if (! e.target.classList.contains('group_node')) {
                            this.editableGroup = {
                                id: null,
                                name: null,
                            };
                        }
                    },
                }
            });
        </script>
    @endPushOnce
</x-admin::layouts>

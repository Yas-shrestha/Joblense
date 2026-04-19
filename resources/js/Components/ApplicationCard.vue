<template>
    <div
        style="
            border: 1px solid #e5e5e5;
            border-radius: 10px;
            padding: 16px 20px;
            margin-bottom: 12px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        "
    >
        <!-- Left: company + role -->
        <div>
            <p style="font-weight: 600; margin: 0 0 4px">{{ job.company }}</p>
            <p style="color: #555; font-size: 14px; margin: 0">
                {{ job.role }}
            </p>
        </div>

        <!-- Right: badge + date + delete -->
        <div style="text-align: right">
            <!-- DISPLAY MODE: show the badge -->
            <span
                v-if="!editing"
                @click="startEditing"
                style="cursor: pointer"
                title="Click to change status"
            >
                <StatusBadge :status="job.status" />
            </span>

            <!-- EDIT MODE: show a dropdown -->
            <select
                v-else
                v-model="newStatus"
                @change="saveStatus"
                @blur="cancelEditing"
                style="
                    padding: 4px 8px;
                    border-radius: 6px;
                    border: 1px solid #ddd;
                    font-size: 13px;
                    cursor: pointer;
                "
            >
                <option value="Applied">Applied</option>
                <option value="Interview">Interview</option>
                <option value="Offer">Offer</option>
                <option value="Rejected">Rejected</option>
            </select>

            <p style="font-size: 12px; color: #999; margin: 6px 0 4px">
                {{ job.date }}
            </p>

            <button
                @click="$emit('delete', job.id)"
                style="
                    font-size: 12px;
                    color: #999;
                    background: none;
                    border: none;
                    cursor: pointer;
                    padding: 0;
                "
            >
                Remove
            </button>
        </div>
    </div>
</template>

<script setup>
import { ref } from "vue";
import { router } from "@inertiajs/vue3";
import StatusBadge from "./StatusBadge.vue";

const props = defineProps({
    job: Object,
});

defineEmits(["delete"]);

const editing = ref(false);

const newStatus = ref(props.job.status);

function startEditing() {
    editing.value = true;
}
function cancelEditing() {
    editing.value = false;
    newStatus.value = props.job.status; // reset to original if cancelled
}
function saveStatus() {
    router.patch(
        `/applications/${props.job.id}`,
        {
            status: newStatus.value,
        },
        {
            onSuccess: () => {
                editing.value = false;
            },
        },
    );
}
</script>

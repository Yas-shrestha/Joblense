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
            <StatusBadge :status="job.status" />
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
import StatusBadge from "./StatusBadge.vue";

defineProps({
    job: Object,
});

defineEmits(["delete"]);
</script>

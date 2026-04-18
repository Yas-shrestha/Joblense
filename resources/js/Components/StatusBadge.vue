<template>
    <span :style="badgeStyle">{{ status }}</span>
</template>

<script setup>
const props = defineProps({
    status: String,
});

const colors = {
    Applied: { background: "#EFF6FF", color: "#1D4ED8" },
    Interview: { background: "#FFF7ED", color: "#C2410C" },
    Offer: { background: "#F0FDF4", color: "#15803D" },
    Rejected: { background: "#FEF2F2", color: "#B91C1C" },
};

const c = colors[props.status] || { background: "#F3F4F6", color: "#374151" };

const badgeStyle = {
    ...c,
    padding: "4px 10px",
    borderRadius: "20px",
    fontSize: "12px",
    fontWeight: "500",
};
</script>

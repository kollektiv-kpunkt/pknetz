module.exports = {
  content: require("fast-glob").sync(["./**/*.php", "*.php"]),
  safelist: ["bg-accent-10"],
  theme: {
    extend: {
      colors: {
        accent: {
          DEFAULT: "var(--obb-accent)",
          05: "var(--obb-accent-05)",
          10: "var(--obb-accent-10)",
          15: "var(--obb-accent-15)",
          20: "var(--obb-accent-20)",
          25: "var(--obb-accent-25)",
          30: "var(--obb-accent-30)",
          35: "var(--obb-accent-35)",
          40: "var(--obb-accent-40)",
          45: "var(--obb-accent-45)",
          55: "var(--obb-accent-55)",
          60: "var(--obb-accent-60)",
        },
        current: "currentColor",
        white: "#ffffff",
      },
    },
  },
  plugins: [],
};

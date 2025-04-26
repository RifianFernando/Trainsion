"use client";

import { deleteTrainByID } from "@/api/bookingTrain";
import { Button } from "@mui/material";

type Props = {
    trainID: string;
};

export default function DeleteTrainButton({ trainID }: Props) {
    const handleDeleteTrain = async (trainID: string) => {
        await deleteTrainByID(trainID).finally(() => window.location.reload());
    };
    return (
        <Button
            onClick={() => handleDeleteTrain(trainID)}
            variant="contained"
            color="warning"
            id="monitor-benq-ex2710q-dropdown"
            aria-labelledby="monitor-benq-ex2710q-dropdown-button"
        >
            Delete
        </Button>
    );
}

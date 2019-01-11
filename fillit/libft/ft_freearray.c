/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   ft_freearray.c                                     :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: bclerc <bclerc@student.42.fr>              +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/01/11 14:18:38 by bclerc            #+#    #+#             */
/*   Updated: 2019/01/11 14:19:39 by bclerc           ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "libft.h"

void	ft_freearray(char **array)
{
	int index;
	
	index = 0;
	while (array[index])
	{
		free(array[index]);
		index++;
	}
	free(array);
}
